
import dynamic from 'next/dynamic';

import Loading from '@/components/Elements/Loading';
import { GetServerSidePropsContext } from 'next';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { queryClient } from '@/queries';
import { dehydrate } from 'react-query';

const ContactScreen = dynamic(() => import('@components/Screens/Contact'), {
  loading: () => <Loading />,
  ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'), {
      loading: () => <Loading />,
      ssr: false,
    });
export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
      return {
        props: {
            ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['contact', 'home'])),
            dehydratedState: dehydrate(queryClient),
        },
      };
    }
function Contact() {
  return (
    <Layout>
      <ContactScreen />
    </Layout>
  );
}

export default Contact;
