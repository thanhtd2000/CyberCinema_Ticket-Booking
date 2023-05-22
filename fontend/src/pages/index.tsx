import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import dynamic from 'next/dynamic';
import { QueryClient, dehydrate } from 'react-query';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';

import { LANGUAGE_DEFAULT, baseParams } from '@/configs/const.config';
import { ELanguage } from '@/configs/interface.config';
import { getListPostFromDatabase } from '@/queries/apis/post';
import { TPost } from '@/modules/post';
import { GET_LIST_COMPANY, GET_LIST_TYPICAL_COMPANY } from '@/queries/keys/company';

const HomeScreen = dynamic(() => import('@components/Screens/Home'), { loading: () => <div>Loading...</div> });
const Layout = dynamic(() => import('@/components/Layouts'));
// export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
//   const queryClient = new QueryClient();
//   // News
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
//   // Company Typical
//   const paramsTypical = {
//     ...baseParams,
//     limit: 6,
//     lang: (locale as ELanguage) || ELanguage.VI,
//     typical: 1,
//   };
//   await queryClient.prefetchQuery([GET_LIST_TYPICAL_COMPANY, JSON.stringify(paramsTypical)], () =>
//     getListPostFromDatabase(paramsTypical),
//   );
//   // List Company
//   const paramsCompany = {
//     ...baseParams,
//     limit: 9,
//     lang: (locale as ELanguage) || ELanguage.VI,
//   };
//   await queryClient.prefetchQuery([GET_LIST_COMPANY, JSON.stringify(paramsCompany)], () =>
//     getListPostFromDatabase(paramsCompany),
//   );
//   return {
//     props: {
//       ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['common', 'home'])),
//       dehydratedState: dehydrate(queryClient),
//       HotNews,
//       ListNews,
//     },
//   };
// }
function Home() {
//   const { HotNews, ListNews } = props;

  return (
    <Layout>
      <HomeScreen/>
    </Layout>
  );
}
export default Home;
