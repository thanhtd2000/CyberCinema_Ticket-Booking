import '@/styles/globals.less';
import { ReactQueryDevtools } from 'react-query/devtools';
import type { AppProps } from 'next/app';
import { QueryClientProvider } from 'react-query';
import { useEffect } from 'react';
import { useRouter } from 'next/router';
import nProgress from 'nprogress';
import { appWithTranslation } from 'next-i18next';

import { queryClient } from '@/queries';
import logger from '@libs/logger';
import { GlobalStateProvider } from '@/libs/GlobalStateContext';

function App({ Component, pageProps }: AppProps) {
  const router = useRouter();
  useEffect(() => {
    nProgress.configure({ showSpinner: false });
    const handleStart = (url: string) => {
      logger.debug('🚀 ~ handleStart ~ url', url);
      nProgress.start();
    };
    const handleStop = (url: string) => {
      logger.debug('🚀 ~ handleStop ~ url', url);
      nProgress.done();
    };
    router.events.on('routeChangeStart', handleStart);
    router.events.on('routeChangeComplete', handleStop);
    router.events.on('routeChangeError', handleStop);
    return () => {
      nProgress.remove();
      router.events.off('routeChangeStart', handleStart);
      router.events.off('routeChangeComplete', handleStop);
      router.events.off('routeChangeError', handleStop);
    };
  }, [router]);

  return (
    <QueryClientProvider client={queryClient}>
      <GlobalStateProvider>
      <Component {...pageProps} />
      </GlobalStateProvider>
      <ReactQueryDevtools initialIsOpen={false} position='bottom-right' />
    </QueryClientProvider>
  );
}
export default appWithTranslation(App);
