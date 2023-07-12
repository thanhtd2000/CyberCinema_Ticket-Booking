
import { getPostBySlug } from '@/queries/apis/post';
import { Spin } from 'antd';
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import dynamic from 'next/dynamic';
import React from 'react'
import { QueryClient, dehydrate } from 'react-query';
const Layout = dynamic(() => import('@/components/Layouts'), { loading: () => <Spin></Spin> });
const NewDetailScreen = dynamic(() => import('@/components/Screens/NewDetail'), { loading: () => <Spin></Spin> });
export async function getServerSideProps({ query }: GetServerSidePropsContext) {
  const queryClient = new QueryClient();
  // News
  const fetchNewDetail = await getPostBySlug(query?.slug as string);
  return {
    props: {
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