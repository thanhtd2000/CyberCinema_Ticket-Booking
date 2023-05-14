import { useQuery } from 'react-query';

import { TResDataListApi } from '@/configs/interface.config';
import { TCompany, TQueryParamsGetCompany } from '@/modules/company';

import { getListCompany } from '../apis/company';

export const queryAllCompany = (params: TQueryParamsGetCompany, key: string) =>
  useQuery<TResDataListApi<TCompany[]>>({
    queryKey: [key, JSON.stringify(params)],
    queryFn: () => getListCompany(params),
    refetchOnMount: false,
    keepPreviousData: true,
  });
