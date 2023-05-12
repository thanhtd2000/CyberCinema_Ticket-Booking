import { useQuery } from 'react-query';

import { TQueryParamsGetData, TResDataListApi } from '@/configs/interface.config';
import { TCategory } from '@/modules/category';

import { getListCategory } from '../apis/baseData';
import { GET_ALL_CATEGORY } from '../keys/categories';
export const queryAllCategory = (params: TQueryParamsGetData) =>
  useQuery<TResDataListApi<TCategory[]>>({
    queryKey: [GET_ALL_CATEGORY, JSON.stringify(params)],
    queryFn: () => getListCategory(params),
    refetchOnMount: false,
    keepPreviousData: true,
  });
