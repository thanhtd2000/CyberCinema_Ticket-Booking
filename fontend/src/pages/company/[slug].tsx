import React from 'react';
import { useRouter } from 'next/router';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import { GetServerSidePropsContext } from 'next';
import { QueryClient, dehydrate } from 'react-query';

import Layout from '@/components/Layouts';
import { ELanguage, EOrderBy } from '@/configs/interface.config';
import CompanyDetail from '@/components/Screens/CompanyDetail';
import { queryAllPostByView } from '@/queries/hooks/post';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';

export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
  return {
    props: {
      ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['common', 'home', 'news'])),
      dehydratedState: dehydrate(queryClient),
    },
  };
}
function Post() {
  return (
    <Layout withSearch>
      <CompanyDetail />
    </Layout>
  );
}

export default Post;
