import { request } from '@/configs/api.config';
import { TQueryParamsGetData } from '@/configs/interface.config';

export const getListCategory = (params: TQueryParamsGetData) => request({ url: 'category', method: 'GET', params });
