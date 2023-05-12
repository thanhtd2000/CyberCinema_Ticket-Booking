import NextHead from 'next/head';
import React from 'react';

const ogImageDefault = 'https://twinger.vn/wp-content/themes/main/screenshot.png?v=21092022';
const faviconDefault = 'https://twinger.vn/wp-content/themes/main/assets/images/favicon.png';

export type THead = {
  description?: string,
  ogImage?: string,
  favicon?: string,
  title?: string,
  url?: string,
  keywords?: string,
  metaTags?: React.ReactNode,
};
function Head({
  title = 'Twinger core',
  description = 'Twinger core website',
  keywords = 'Twinger, Website development, Applications, Web, App, UI/UX, Hosting, Landing page, Server',
  url = typeof window !== 'undefined' ? window.location.href : process.env.BASE_URL || 'https://twinger.vn',
  ogImage = `${process.env.BASE_URL ? `${process.env.BASE_URL}screenshot.jpg?v=04102022` : ogImageDefault}`,
  favicon = `${process.env.BASE_URL ? `${process.env.BASE_URL}favicon.ico?v=04102022` : faviconDefault}`,
  metaTags,
}: THead) {
  return (
    <NextHead>
      <meta charSet='UTF-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1, viewport-fit=cover' />
      <link rel='icon' href={favicon} />
      <meta name='author' content='twinger.vn' />
      <meta property='og:type' content='website' />
      <meta property='og:url' content={url} />
      <meta name='twitter:site' content={url} />
      <meta name='twitter:card' content='summary' />
      <meta name='twitter:image' content={ogImage} />
      <meta property='og:image' content={ogImage} />
      <meta name='thumbnail' content={ogImage} />
      <meta name='keywords' content={keywords} />
      <meta property='og:url' content={url} />
      <meta property='og:image' content={ogImage} />
      <meta name='twitter:title' content={title} />
      <meta property='og:title' content={title} />
      <meta property='og:site_name' content={title} />
      <title>{title}</title>
      <meta property='og:description' content={description} />
      <meta name='description' content={description} />
      {metaTags}
    </NextHead>
  );
}

export default Head;
