import { request } from '@/configs/api.config';
import { TQueryParamsGetCompany } from '@/modules/company';

export const getListCompany = (params: TQueryParamsGetCompany) =>
  request({ url: 'company/companies', method: 'GET', params });
