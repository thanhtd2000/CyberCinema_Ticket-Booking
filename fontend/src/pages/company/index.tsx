import React from 'react';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import { GetServerSidePropsContext } from 'next';
import { QueryClient, dehydrate } from 'react-query';

import Layout from '@/components/Layouts';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import ListPost from '@/components/Screens/Post/component/ListPost/ListPost';
import CompanyScreen from '@/components/Screens/CompanyScreen';

export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
  return {
    props: {
      ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['common', 'home', 'news'])),
      dehydratedState: dehydrate(queryClient),
    },
  };
}
function Company() {
  return (
    <Layout>
      <CompanyScreen />
    </Layout>
  );
}

export default Company;
