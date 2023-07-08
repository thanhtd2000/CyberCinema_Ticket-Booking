import { TUser } from '@/modules';

/* eslint-disable @typescript-eslint/no-explicit-any */
export enum EStatusDoc {
  ACTIVE = 'active', // Đang hoạt động
  DRAFT = 'draft', // Dự thảo or nháp
  INACTIVE = 'inactive', // Không hoạt động
  PENDING = 'pending', // Chờ phê duyệt
}

export type TStatusDoc = {
  key: number;
  value: EStatusDoc;
};

export enum ERole {
  GUEST = 'GUEST',
  EDITOR = 'EDITOR',
  ADMINISTRATOR = 'ADMINISTRATOR',
}

export enum ELanguage {
  VI = 'vi',
  EN = 'en',
}

export enum EOrder {
  DESC = 'DESC',
  ASC = 'ASC',
}

export enum EOrderBy {
  ID = '_id',
  CREATED_DATE = 'date',
  UPDATED_DATE = 'updated_at',
  NAME = 'name',
  VIEWER = 'viewer',
}

export interface IStatusCode {
  statusCode: number;
}

export interface IMessage {
  message: string;
}

export interface ILimit {
  limit?: number;
}

export interface IPage {
  page?: number;
}

export interface IExtra<T = any> {
  [key: string]: T;
}
export interface IOption {
  value: string;
  label: string;
}

export type TQueryParamsGetData<T = any> = ILimit &
  IPage & {
    orderBy?: EOrderBy | undefined;
    order?: EOrder;
    s?: string;
  } & T;
export type TBaseData = {
  id: string;
  name: string;
  createdAt: Date;
  updated_at: Date;
  translation: TDataInitTranslation;
};
export type TTranslationField<T = any> = Record<ELanguage, T>;
export type TDataInitTranslation = {
  lang: ELanguage;
  translation: TTranslationField;
  publishedLanguage?: ELanguage[];
  [key: string]: any;
};
export type TResDataListApi<T = any, K = any> = {
  page: number;
  limit: number;
  total: number;
} & { data: T } & IExtra<K>;

export type TResApi<T = any, K = any> = IStatusCode & IMessage & { data: T } & IExtra<K>;

export type TResApiErr<T = any, K = any> = IStatusCode &
  IMessage & {
    code: number;
    message: string | string[];
    statusText: string;
    status: number | string;
    data: T;
  } & IExtra<K>;

export type TRemoveMany = {
  ids: string[];
};

export type TEditSlug = {
  slug: string;
};
export interface IFilter {
  [key: string]: any;
  'categoryIds[]'?: string[];
  city?: string;
  companySize?: string;
  companySizeFrom?: number;
  companySizeTo?: number;
  s?: string;
}
export type TDocWithTimestamps = {
  createdAt: Date;
  updatedAt: Date;
};

export type TDocWithAuthor = {
  author: TUser;
  editedBy: string;
};
