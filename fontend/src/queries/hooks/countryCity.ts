import { useQuery } from 'react-query';

import { TQueryParamsGetData, TResDataListApi } from '@/configs/interface.config';
import { TCity } from '@/modules/countryCity';

import { getListCity } from '../apis/countryCity';
import { LIST_CITY } from '../keys/countryCity';

export const queryAllCity = (params: TQueryParamsGetData) =>
  useQuery<TResDataListApi<TCity[]>>({
    queryKey: [LIST_CITY, JSON.stringify(params)],
    queryFn: () => getListCity(params),
    refetchOnMount: false,
    keepPreviousData: true,
  });
