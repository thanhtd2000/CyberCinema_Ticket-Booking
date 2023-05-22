import { ELanguage, TQueryParamsGetData } from '@/configs/interface.config';

import { TUser } from './user';

export type TQueryTaxonomy = TQueryParamsGetData<{
  parentId?: string;
  isGenealogy?: 0 | 1;
  postType?: string;
  lang?: ELanguage;
}>;

export type TTaxonomy = {
  _id: string;
  postCount: number;
  author: TUser;
  editedBy: string;
  lang: ELanguage;
  publishedLanguage: ELanguage[];
  name: string;
  slug: string;
  description: string;
  parent: TTaxonomy;
  postType: string;
  left: number;
  right: number;
  nameSort: string;
  createdAt: Date;
  updatedAt: Date;
  __v: number;
};
