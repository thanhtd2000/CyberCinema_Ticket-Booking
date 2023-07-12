import React from 'react'
import NewScreen from '@/components/Screens/News'
import dynamic from 'next/dynamic';
import { Spin } from 'antd';
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import { QueryClient, dehydrate } from 'react-query';
import { getListPostFromDatabase } from '@/queries/apis/post';
import { LANGUAGE_DEFAULT, baseParams } from '@/configs/const.config';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
const Layout = dynamic(() => import('@/components/Layouts'), { loading: () => <Spin></Spin> });
export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
  // News
  const fetchAllHotNews = await getListPostFromDatabase(
    {
      ...baseParams,
      limit: -1,
      isHot: 1,
    },
  );
  const HotNews = fetchAllHotNews.data;
  return {
    props: {
      ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['common', 'home'])),
      dehydratedState: dehydrate(queryClient),
      HotNews,
    },
  };
}
function index(props: InferGetServerSidePropsType<typeof getServerSideProps> ) {
      const { HotNews} = props;
      console.log(HotNews);
  return (
      <Layout>
            <NewScreen listNews={HotNews} />
      </Layout>
  )
}

export default index