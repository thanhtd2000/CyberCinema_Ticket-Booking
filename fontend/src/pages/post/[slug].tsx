import React from 'react';
import { useRouter } from 'next/router';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import { GetServerSidePropsContext } from 'next';
import { QueryClient, dehydrate } from 'react-query';

import Layout from '@/components/Layouts';
import { ELanguage, EOrderBy } from '@/configs/interface.config';
import PostDetail from '@/components/Screens/PostDetail/component/PostDetail';
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
  const router = useRouter();
  const slug = router.query.slug?.toString();
  const { data: fetchAllNewTopView } = queryAllPostByView(
    {
      orderBy: EOrderBy.VIEWER,
    },
    router.locale as ELanguage,
  );
  const listPostView = fetchAllNewTopView?.data.slice(0, 5);
  return <Layout withSearch>{slug && listPostView && <PostDetail slug={slug} listPostView={listPostView} />}</Layout>;
}

export default Post;
