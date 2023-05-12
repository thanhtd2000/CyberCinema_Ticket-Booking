import { request } from '@/configs/api.config';
import { ELanguage } from '@/configs/interface.config';
import { TQueryTaxonomy } from '@/modules/taxonomy';

export const getListTaxonomy = (params: TQueryTaxonomy, lang: ELanguage) =>
  request({ url: 'taxonomy/web', method: 'GET', params: { ...params } }, { lang });
export const getTaxonomyBySlug = (slug: string, lang: ELanguage) =>
  request({ url: `taxonomy/${slug}/detail`, method: 'GET' }, { lang });
