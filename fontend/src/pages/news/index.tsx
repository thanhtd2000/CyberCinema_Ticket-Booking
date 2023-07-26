import React from 'react'
import dynamic from 'next/dynamic';
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import { QueryClient, dehydrate } from 'react-query';
import { getListPostFromDatabase } from '@/queries/apis/post';
import { LANGUAGE_DEFAULT, baseParams } from '@/configs/const.config';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import Loading from '@/components/Elements/Loading';
const Layout = dynamic(() => import('@/components/Layouts'), { loading: () => <Loading /> });
const NewScreen = dynamic(() => import('@/components/Screens/News'), { loading: () => <Loading /> });
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