
import { Spin } from 'antd';
import dynamic from 'next/dynamic';
import React from 'react'
const BookingTicketScreen = dynamic(() => import('@/components/Screens/BookingTicket'), {
      loading: () => <Spin />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
function index() {
      return (
            <Layout>
                  <BookingTicketScreen />
            </Layout>
      )
}

export default index