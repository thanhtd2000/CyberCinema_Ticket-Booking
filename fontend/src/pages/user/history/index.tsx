import Loading from '@/components/Elements/Loading';
import { checkAuth } from '@/libs/localStorage';
import dynamic from 'next/dynamic';
import React, { useEffect } from 'react';
import { useRouter } from 'next/router';
const HistoryScreen = dynamic(() => import('@/components/Screens/History'), {
  loading: () => <Loading />,
  ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
function index() {
  const token = checkAuth();
  const router = useRouter();
  useEffect(() => {
    if (!token) {
      router.push('/404');
    }
  }, []);
  return (
    <Layout>
      <HistoryScreen />
    </Layout>
  );
}

export default index;
