
import Loading from '@/components/Elements/Loading';
import dynamic from 'next/dynamic';
import React from 'react'
const HistoryScreen = dynamic(() => import('@/components/Screens/History'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
function index() {
  return (
    <Layout>
      <HistoryScreen />
    </Layout>
  )
}

export default index