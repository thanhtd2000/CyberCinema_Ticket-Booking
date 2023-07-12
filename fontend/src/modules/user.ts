import { TFile } from './media';
import { TRole } from './role';

export type TUser = {
  [x: string]: ReactI18NextChildren;
  _id: string;
  username: string;
  email: string;
  phone: string;
  lastName: string;
  firstName: string;
  isActive: boolean;
  avatar: TFile;
  roles: TRole[];
  createdAt: Date;
  updateAt: Date;
};
