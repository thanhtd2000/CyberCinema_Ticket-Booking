import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import dynamic from 'next/dynamic';
import { QueryClient, dehydrate } from 'react-query';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';

import { LANGUAGE_DEFAULT, baseParams } from '@/configs/const.config';
import { getListMovieFromDatabase } from '@/queries/apis/movies';
import { Spin } from 'antd';
import { getListPostFromDatabase } from '@/queries/apis/post';
import Loading from '@/components/Elements/Loading';
const HomeScreen = dynamic(() => import('@components/Screens/Home'), { loading: () => <Loading /> });
const Layout = dynamic(() => import('@/components/Layouts'), { loading: () => <Loading /> });
export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
//   Movies
  const fetchAllMovies = await getListMovieFromDatabase()
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
      fetchAllMovies,
    },
  };
}
function Home(props: InferGetServerSidePropsType<typeof getServerSideProps> ) {
  const { fetchAllMovies , HotNews} = props;
  const dataMovies = fetchAllMovies.data.slice(0,8)
  return (
    <Layout>
      {dataMovies && dataMovies ? (<HomeScreen HotNews={HotNews} fetchAllMovies={dataMovies}/>) : <Spin></Spin>}
    </Layout>
  );
}
export default Home;
