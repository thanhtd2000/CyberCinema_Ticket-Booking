import React from 'react';
import Link from 'next/link';

import Layout from '@components/Layouts';

function Page1Screen() {
  return (
    <Layout title='Page1 screen'>
      <p>
        APP_ENV:
        {process.env.APP_ENV}
      </p>
      <p>
        <Link href='/'>Home Screen</Link>
      </p>
    </Layout>
  );
}

export default Page1Screen;
