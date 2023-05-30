import * as CryptoJS from 'crypto-js';

import { KEY_CRYPTO } from './env.config';
import { ELanguage, EOrder, EOrderBy } from './interface.config';

export const formatNumber = new Intl.NumberFormat('en-US', {
  maximumFractionDigits: 2,
});
export const LANGUAGE_DEFAULT = ELanguage.VI;
export const urlHeader = {
  findCompany: '/company',
  news: '/news',
  contact: '/contact',
  signIn: '/',
  signUp: '/',
  forgotPassword: '/forgot-password',
  resetPassword: '/reset-password',
};
export const baseParams = {
  page: 1,
  limit: 10,
  orderBy: EOrderBy.CREATED_DATE,
  slug: '',
  order: EOrder.DESC,
  s: '',
};
// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const decryptedData = (encryptedData: any) => {
  const bytes = CryptoJS.AES.decrypt(encryptedData, KEY_CRYPTO);
  return bytes.toString(CryptoJS.enc.Utf8);
};
export const ListOptionCopmanySize = [
  { value: '1-10', label: { vi: '1-10 nhân viên', en: '1-10 employees' } },
  { value: '11-50', label: { vi: '11-51 nhân viên', en: '11-51 employees' } },
  { value: '51-200', label: { vi: '51-200 nhân viên', en: '51-200 employees' } },
  { value: '201-500', label: { vi: '201-500 nhân viên', en: '201-500 employees' } },
  { value: '501-1000', label: { vi: '501-1000 nhân viên', en: '501-1000 employees' } },
  { value: '1001-5000', label: { vi: '1001-5000 nhân viên', en: '1001-5000 employees' } },
  { value: '5001-10000', label: { vi: '5001-10000 nhân viên', en: '5001-10,000 employees' } },
  { value: '10001', label: { vi: '10,001+ nhân viên', en: '10,001+ employees' } },
];
