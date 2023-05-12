import { request } from '@/configs/api.config';
import { ELanguage } from '@/configs/interface.config';
import { TQueryPost } from '@/modules/post';

export const getListPost = (params: TQueryPost, lang?: ELanguage) =>
  request({ url: 'post/posts', method: 'GET', params: { ...params } }, { lang });
export const getListPostFromDatabase = (params: TQueryPost, lang?: ELanguage) =>
  request({ url: 'post/posts', method: 'GET', params: { ...params } }, { lang });
export const getPostBySlug = (slug: string, lang: ELanguage) =>
  request({ url: `post/${slug}/detail`, method: 'GET' }, { lang });
export const getListPostByViewer = (params: TQueryPost, lang?: ELanguage) =>
  request({ url: 'post/posts', method: 'GET', params: { ...params } }, { lang });
