import { TResApi, TResApiErr } from '@/configs/interface.config';
import { TUpdateStatusChair } from '@/modules/movies';
import { useMutation} from 'react-query';
import { updateStatusChair } from '../apis/chair';
import logger from '@/libs/logger';
import { toast } from 'react-toastify';

  export const useQueryPatchChair = () => {
      return useMutation(({params, token} : {params:TUpdateStatusChair, token: string}) => updateStatusChair(params,token), {
        onSuccess: (data: TResApi) => {
          logger.debug('SignOut data:', data);
        },
        onError: (error: TResApiErr) => {
            toast.error(error?.message, {
                  position: toast.POSITION.BOTTOM_RIGHT,
                });
        }
      });
    };