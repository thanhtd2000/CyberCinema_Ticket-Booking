import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import dynamic from 'next/dynamic';
import { QueryClient, dehydrate } from 'react-query';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';

import { LANGUAGE_DEFAULT, baseParams } from '@/configs/const.config';
import { getListMovieBySearch, getListMovieFromDatabase } from '@/queries/apis/movies';
import { Spin } from 'antd';
import { getListPostFromDatabase } from '@/queries/apis/post';
import Loading from '@/components/Elements/Loading';
const HomeScreen = dynamic(() => import('@components/Screens/Home'), { loading: () => <Loading />, ssr: false });
const Layout = dynamic(() => import('@/components/Layouts'), { loading: () => <Loading />, ssr: false });
export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
//   Movies
  const fetchAllMovies = await getListMovieBySearch({
      ...baseParams,
      limit: 8,
      isHot: 1,
    },)
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

  return (
    <Layout>
      {fetchAllMovies && fetchAllMovies ? (<HomeScreen HotNews={HotNews} fetchAllMovies={fetchAllMovies.data}/>) : <Spin></Spin>}
    </Layout>
  );
}
export default Home;
