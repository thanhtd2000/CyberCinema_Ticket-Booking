import { useInfiniteQuery, useQuery } from 'react-query';

import { ELanguage, TResApi, TResDataListApi } from '@/configs/interface.config';
import { TPost, TQueryPost } from '@/modules/post';

import { getListPostFromDatabase, getPostBySlug } from '../apis/post';
import { LIST_POST } from '../keys/post';

export const queryAllPost = (params: TQueryPost, lang: ELanguage) =>
  useQuery<TResDataListApi<TPost[]>>({
    queryKey: [LIST_POST, JSON.stringify(params), lang],
    queryFn: () => getListPost(params, lang),
    refetchOnMount: false,
    keepPreviousData: true,
  });
export const queryAllPostScroll = (params: TQueryPost, lang: ELanguage) =>
  useInfiniteQuery({
    queryKey: [LIST_POST, params, lang],
    queryFn: ({ pageParam = 1 }) => getListPost({ ...params, page: pageParam }),
    getNextPageParam: (lastPage) =>
      // eslint-disable-next-line prettier/prettier
      (lastPage?.page < Math.ceil(lastPage?.total / lastPage?.limit) ? lastPage?.page + 1 : undefined),
    refetchOnMount: true,
    refetchOnReconnect: true,
    refetchOnWindowFocus: true,
  });
export const queryAllPostFromDatabase = (params: TQueryPost, lang: ELanguage) =>
  useQuery<TResDataListApi<TPost[]>>({
    queryKey: [LIST_POST, JSON.stringify(params), lang],
    queryFn: () => getListPostFromDatabase(params, lang),
    refetchOnMount: false,
    keepPreviousData: true,
  });
export const queryAllPostBySlug = (slug: string, lang: ELanguage) =>
  useQuery<TResApi<TPost>>({
    queryKey: [LIST_POST, JSON.stringify(slug), lang],
    queryFn: () => getPostBySlug(slug, lang),
    refetchOnMount: false,
    keepPreviousData: true,
  });

