import { TDocWithAuthor, TDocWithTimestamps } from '@/configs/interface.config';
import { TUser } from './user';
export type TFolder = {
      _id: string;
      name: string;
      nameSort: string;
      parent: TFolder;
      left: number;
      right: number;
      __v: number;
    } & TDocWithTimestamps &
      TDocWithAuthor;
export type TFile = {
  _id: string;
  name: string;
  originalname: string | null;
  size: number;
  extension: string;
  mimetype: string;
  bucket: string;
  location: string;
  key: string;
  width: number | null;
  height: number | null;
  alt: string | null;
  caption: string | null;
  description: string | null;
  system: string;
  createdAt: Date;
  updatedAt: Date;
  __v: number;
  author: TUser;
  editedBy: string;
};
