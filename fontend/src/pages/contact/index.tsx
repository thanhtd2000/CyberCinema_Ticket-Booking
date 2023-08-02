
import dynamic from 'next/dynamic';

import Loading from '@/components/Elements/Loading';

const ContactScreen = dynamic(() => import('@components/Screens/Contact'), {
  loading: () => <Loading />,
});
const Layout = dynamic(() => import('@/components/Layouts'));

function Contact() {
  return (
    <Layout>
      <ContactScreen />
    </Layout>
  );
}

export default Contact;
