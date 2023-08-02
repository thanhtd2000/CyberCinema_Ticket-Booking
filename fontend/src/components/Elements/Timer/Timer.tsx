import { Typography } from 'antd';
import moment from 'moment';
import { useRouter } from 'next/router';
import { useEffect, useMemo, useState } from 'react';

const { Text } = Typography;
interface ICount {
  expiresAt: number;
}
function CountTime({ expiresAt }: ICount) {
  const [now, setNow] = useState(Math.round(new Date().getTime()));

  useEffect(() => {
    const interval = setInterval(() => setNow(Math.round(new Date().getTime())), 1000);
    return () => clearInterval(interval);
  }, []);

  const startDate = now;
  const router = useRouter(); 
  const endDate = moment(expiresAt);
  const duration = moment.duration(endDate.diff(startDate));
  const exp = +endDate - +startDate;
  const seconds = useMemo(() => (duration.seconds() < 10 ? `0${duration.seconds()}` : duration.seconds()), [duration]);
  useEffect(()=>{
        if(exp <= 0){
            router.push('/')
        }
  },[exp])
  const minutes = useMemo(() => (duration.minutes() < 10 ? `0${duration.minutes()}` : duration.minutes()), [duration]);
  return (
    <Text>{exp <= 0 || !expiresAt ? 'Token Expried' : `${minutes}:${seconds}`}</Text>
  );
}
export default CountTime;
