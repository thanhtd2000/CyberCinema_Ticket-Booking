/** @type {import('next').NextConfig} */
const withImages = require('next-images');
const withLess = require('next-with-less');
const { i18n } = require('./next-i18next.config');

const nextConfig = {
  env: {
    APP_ENV: process.env.APP_ENV || 'development',
    BASE_URL: process.env.BASE_URL || 'http://localhost:3200/',
    API_ENDPOINT: process.env.API_ENDPOINT || 'http://localhost:3200/api',
    API_TIMEOUT: process.env.API_TIMEOUT,
    KEY_CRYPTO: process.env.KEY_CRYPTO,
    CAPTCHA_SITE_KEY: process.env.CAPTCHA_SITE_KEY,
  },
  poweredByHeader: false,
  reactStrictMode: true,
  swcMinify: true,
  compress: true,
  generateBuildId: async () => '2gv57B6qZFR48BIuET&m4f3v',
  eslint: {
    ignoreDuringBuilds: true,
  },
  typescript: {
    ignoreBuildErrors: true,
  },
  distDir: 'dist',
  images: {
    domains: ['s3.cloud.cmctelecom.vn','storage.googleapis.com'],
  },
  webpack: (config, { buildId, dev, isServer, defaultLoaders, nextRuntime, webpack }) => {
    const conf = config;
    conf.plugins = conf.plugins.filter((plugin) => plugin.constructor.name !== 'ForkTsCheckerWebpackPlugin');

    conf.watchOptions = {
      aggregateTimeout: 300,
      poll: 5000,
      ignored: ['**/.git', '**/.next', '**/node_modules', '**/public/static'],
    };

    return config;
  },
  i18n: {
    defaultLocale: 'vi',
    locales: ['vi', 'en'],
    localeDetection: false,
  },
};

module.exports = () => {
  const plugins = [withImages, withLess];
  return plugins.reduce((acc, plugin) => plugin(acc), { ...nextConfig });
};
