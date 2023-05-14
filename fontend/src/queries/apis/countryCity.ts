import { request } from '@/configs/api.config';
import { TQueryParamsGetCity } from '@/modules/countryCity';

export const getListCity = (params: TQueryParamsGetCity) => request({ url: 'city', method: 'GET', params });
