/* eslint-disable @typescript-eslint/no-explicit-any */
import { QueryClient } from 'react-query';
import { toast } from 'react-toastify';

import { checkAuth } from '@/libs/localStorage';
import logger from '@libs/logger';

import { refreshTokenFn } from './hooks';

function queryErrorHandler(error: any): void {
  toast.error(error?.message);
  // error is type unknown because in js, anything can be an error (e.g. throw(5))
  const accessToken = checkAuth();
  const id = 'react-query-error';
  const title = error instanceof Error ? error.toString().replace(/^Error:\s*/, '') : 'error connecting to server';
  if (error?.statusCode === 401 && accessToken) {
    refreshTokenFn();
  } else {
    // Todo
  }
  // prevent duplicate toasts
  // TODO...
  logger.debug('🚀 ~ Query onError:', { id, title, error });
}

function querySuccessHandler(res: any): void {
  if (res && res?.message) {
    toast.success(res?.message);
  }
}

export const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      onError: queryErrorHandler,
      staleTime: 600000, // 10 minutes
      cacheTime: 900000, // 15 minutes
      refetchOnMount: true,
      refetchOnReconnect: true,
      refetchOnWindowFocus: true,
      retry: 2,
    },
    mutations: {
      onError: queryErrorHandler,
      onSuccess: querySuccessHandler,
    },
  },
});
