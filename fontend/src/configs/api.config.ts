/* eslint-disable @typescript-eslint/no-explicit-any */
import axios, { AxiosRequestConfig } from 'axios';

import logger from '@/libs/logger';
import { checkAuth } from '@/libs/localStorage';

import { API_ENDPOINT, API_TIMEOUT, BASE_URL } from './env.config';
import { ELanguage } from './interface.config';
import { LANGUAGE_DEFAULT, decryptedData } from './const.config';

const client = axios.create({
  baseURL: API_ENDPOINT,
  timeout: 100000,
  timeoutErrorMessage: '🚧🚧🚧 Server connection time out!',
  headers: {
    Accept: 'application/json',
    xsrfCookieName: 'XSRF-TOKEN',
    xsrfHeaderName: 'X-XSRF-TOKEN',
    responseEncoding: 'utf8',
    responseType: 'json',
    'Content-Type': 'application/json',
    'Cache-Control': 'no-cache, no-store, must-revalidate',
    'Access-Control-Allow-Origin': BASE_URL,
    'X-Application': 'web app',
    'X-Version': '1.0.1',
  },
});

export const request = async (
  options: AxiosRequestConfig,
  additional?: { lang?: ELanguage | string; token?: string },
) => {
  logger.debug('🚧🚧🚧 ~ Axios Options:', options);

  if (additional?.token || checkAuth()) {
    client.defaults.headers.common.Authorization = `Bearer ${additional?.token || checkAuth()}`;
  }

  client.defaults.headers.common.lang = additional?.lang || LANGUAGE_DEFAULT;

  const onSuccess = (response: any) => {
    const { data } = response;
    let result = data;
    // if (process.env.APP_ENV === 'production') {
    //   result = JSON.parse(decryptedData(data));
    // }
//     result = JSON.parse(decryptedData(data));
    logger.debug('🚀🚀🚀 ~ Response API:', result);
    return result;
  };

  const onError = async (error: any) => {
    logger.error('🚨🚨🚨 ~ Axios onError:', onError);
    await Promise.reject({
      statusCode: error?.response?.data?.statusCode,
      message: error?.response?.data?.message,
      statusText: error?.response?.statusText,
      status: error?.response?.status,
      data: error?.response?.data?.data || null,
    });
  };
  return client(options).then(onSuccess).catch(onError);
};
