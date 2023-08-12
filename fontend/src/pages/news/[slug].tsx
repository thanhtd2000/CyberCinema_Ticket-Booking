
import Loading from '@/components/Elements/Loading';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { getPostBySlug } from '@/queries/apis/post';
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import dynamic from 'next/dynamic';
import React from 'react'
import { QueryClient, dehydrate } from 'react-query';
const Layout = dynamic(() => import('@/components/Layouts'), { loading: () => <Loading/>, ssr: false });
const NewDetailScreen = dynamic(() => import('@/components/Screens/NewDetail'), { loading: () => <Loading/>, ssr: false  });
export async function getServerSideProps({ query, locale }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
  // News
  const fetchNewDetail = await getPostBySlug(query?.slug as string);
  return {
    props: {
      ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['movies', 'home'])),
      dehydratedState: dehydrate(queryClient),
      fetchNewDetail,
    },
  };
}
function Movie(props: InferGetServerSidePropsType<typeof getServerSideProps> ) {
      const {fetchNewDetail} = props
  return (
      <Layout>
            <NewDetailScreen fetchNewDetail={fetchNewDetail} />
      </Layout>
  )
}

export default Movie