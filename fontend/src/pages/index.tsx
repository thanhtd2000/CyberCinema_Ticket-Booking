import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import dynamic from 'next/dynamic';
import { QueryClient, dehydrate } from 'react-query';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';

import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { getListMovieFromDatabase } from '@/queries/apis/movies';
import { Spin } from 'antd';

const HomeScreen = dynamic(() => import('@components/Screens/Home'), { loading: () => <Spin></Spin> });
const Layout = dynamic(() => import('@/components/Layouts'), { loading: () => <Spin></Spin> });
export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
//   Movies
  const fetchAllMovies = await getListMovieFromDatabase()
  // News
//   const fetchAllHotNews = await getListPostFromDatabase(
//     {
//       ...baseParams,
//       limit: -1,
//       isHot: 1,
//     },
//     locale as ELanguage,
//   );
//   const notInIdsNews = fetchAllHotNews?.data?.map((item: TPost) => item._id) || [];
//   const fetchNews = await getListPostFromDatabase(
//     {
//       ...baseParams,
//       limit: 3,
//       'notInIds[]': notInIdsNews,
//     },
//     locale as ELanguage,
//   );
//   const HotNews = fetchAllHotNews.data;
//   const ListNews = fetchNews.data;
  // Company Typical
//   const paramsTypical = {
//     ...baseParams,
//     limit: 6,
//     lang: (locale as ELanguage) || ELanguage.VI,
//     typical: 1,
//   };
//   await queryClient.prefetchQuery([GET_LIST_TYPICAL_COMPANY, JSON.stringify(paramsTypical)], () =>
//     getListPostFromDatabase(paramsTypical),
//   );
  // List Company
//   const paramsCompany = {
//     ...baseParams,
//     limit: 9,
//     lang: (locale as ELanguage) || ELanguage.VI,
//   };
//   await queryClient.prefetchQuery([GET_LIST_COMPANY, JSON.stringify(paramsCompany)], () =>
//     getListPostFromDatabase(paramsCompany),
//   );
  return {
    props: {
      ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['common', 'home'])),
      dehydratedState: dehydrate(queryClient),
      // HotNews,
      fetchAllMovies
      // ListNews,
    },
  };
}
function Home(props: InferGetServerSidePropsType<typeof getServerSideProps> ) {
  const { fetchAllMovies } = props;
  const dataMovies = fetchAllMovies.data
  return (
    <Layout>
      {dataMovies && dataMovies ? (<HomeScreen fetchAllMovies={dataMovies}/>) : <div>loading...</div>}
    </Layout>
  );
}
export default Home;
