<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\Checkout\Preprocessor\Adapter\Scss;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Filesystem;
use Magento\Framework\View\Asset\File\Context;
use Magento\Framework\View\Asset\File\FallbackContext;
use Magento\Framework\View\Asset\LocalInterface;
use Magento\Framework\View\Design\FileResolution\Fallback\Resolver\Simple;
use Magento\Framework\View\Design\FileResolution\Fallback\StaticFile;
use Magento\Framework\View\Design\Theme\ThemeProviderInterface;
use MageWorx\Checkout\Helper\Colors;
use Psr\Log\LoggerInterface;
use Magento\Framework\View\Asset\File;
use Magento\Framework\View\Asset\Source;
use Magento\Framework\View\Asset\ContentProcessorInterface;
use ScssPhp\ScssPhp\Compiler;

class Processor implements ContentProcessorInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Source
     */
    private $assetSource;

    /**
     * @var Colors
     */
    private $colorsConfig;

    /**
     * @var StaticFile
     */
    private $fallback;

    /**
     * @var ThemeProviderInterface
     */
    private $themeProvider;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * Constructor
     *
     * @param Source $assetSource
     * @param Colors $colorsConfig
     * @param StaticFile $fallback
     * @param Filesystem $filesystem
     * @param LoggerInterface $logger
     */
    public function __construct(
        Source $assetSource,
        Colors $colorsConfig,
        StaticFile $fallback,
        Filesystem $filesystem,
        LoggerInterface $logger
    ) {
        $this->assetSource  = $assetSource;
        $this->colorsConfig = $colorsConfig;
        $this->logger       = $logger;
        $this->fallback     = $fallback;
        $this->filesystem   = $filesystem;
    }

    /**
     * Process file content
     *
     * @param File $asset
     * @return string
     */
    public function processContent(File $asset)
    {
        $path = $asset->getPath();
        try {
            /** @var Compiler $compiler */
            $compiler = new \ScssPhp\ScssPhp\Compiler();
            $content  = $this->assetSource->getContent($asset);

            if (trim($content) === '') {
                return '';
            }

            $compiler->setVariables(
                [
                    'color-accent'                 => $this->colorsConfig->getAccentBaseColor(),
                    'color-accent-header'          => $this->colorsConfig->getHeaderBaseColor(),
                    'color-accent-checkout-button' => $this->colorsConfig->getCheckoutBaseColor(),
                ]
            );

            $realSourcePath = $this->getRealSourcePath($asset);

            return $compiler->compile($content, $realSourcePath);
        } catch (\Exception $e) {
            $errorMessage = PHP_EOL . self::ERROR_MESSAGE_PREFIX . PHP_EOL . $path . PHP_EOL . $e->getMessage();
            $this->logger->critical($errorMessage);

            return $errorMessage;
        }
    }

    /**
     * Get real source file path in the module dir
     *
     * @param File $asset
     * @return string
     */
    private function getRealSourcePath(File $asset): string
    {
        $context = $asset->getContext();

        if ($context instanceof FallbackContext) {
            $result = $this->findFileThroughFallback($asset, $context);
        } elseif ($context instanceof Context) {
            $result = $this->findFile($asset, $context);
        } else {
            $type = get_class($context);
            throw new \LogicException("Support for {$type} is not implemented.");
        }

        return $result;
    }

    /**
     * Find asset file by appending its path to the directory in context
     *
     * @param LocalInterface $asset
     * @param Context $context
     * @return string
     */
    private function findFile(
        LocalInterface $asset,
        Context $context
    ): string {
        Simple::assertFilePathFormat($asset->getFilePath());

        $dir = $this->filesystem->getDirectoryRead($context->getBaseDirType());

        return $dir->getAbsolutePath($asset->getPath());
    }

    /**
     * Find asset file via fallback mechanism
     *
     * @param LocalInterface $asset
     * @param FallbackContext $context
     * @return bool|string
     */
    private function findFileThroughFallback(
        LocalInterface $asset,
        FallbackContext $context
    ) {
        $basePath = $context->getAreaCode() . '/' . $context->getThemePath();
        $themeModel = $this->getThemeProvider()
                           ->getThemeByFullPath($basePath);

        $fileInModuleDirectory = $this->fallback->getFile(
            $context->getAreaCode(),
            $themeModel,
            $context->getLocale(),
            $asset->getFilePath(),
            $asset->getModule()
        );

        return $fileInModuleDirectory;
    }

    /**
     * @return ThemeProviderInterface
     */
    private function getThemeProvider(): ThemeProviderInterface
    {
        if (null === $this->themeProvider) {
            $this->themeProvider = ObjectManager::getInstance()->get(ThemeProviderInterface::class);
        }

        return $this->themeProvider;
    }
}
