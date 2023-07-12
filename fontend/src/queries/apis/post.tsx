import { request } from '@/configs/api.config';
import { TQueryPost } from '@/modules/post';

export const getListPostFromDatabase = (params: TQueryPost) =>
  request({ url: '/get/posts', method: 'GET', params: { ...params } });
export const getPostBySlug = (slug: string) =>
  request({ url: `/get/post/detail/${slug}`, method: 'GET' });

