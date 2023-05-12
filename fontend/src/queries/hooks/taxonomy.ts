import { useQuery } from 'react-query';

import { ELanguage, TResDataListApi } from '@/configs/interface.config';
import { TQueryPost } from '@/modules/post';
import { TTaxonomy } from '@/modules/taxonomy';

import { getListTaxonomy } from '../apis/taxonomy';
import { LIST_TAXONOMY } from '../keys/taxonomy';

export const queryAllTaxonomy = (params: TQueryPost, lang: ELanguage) =>
  useQuery<TResDataListApi<TTaxonomy[]>>({
    queryKey: [LIST_TAXONOMY, JSON.stringify(params), lang],
    queryFn: () => getListTaxonomy(params, lang),
    refetchOnMount: false,
    keepPreviousData: true,
  });
