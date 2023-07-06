import { Typography } from 'antd';
import moment from 'moment';
import { useEffect, useMemo, useState } from 'react';

// import style from './style.module.less';

const { Text } = Typography;
interface ICount {
  expiresAt: number;
}
function CounTime({ expiresAt }: ICount) {
  const [now, setNow] = useState(Math.round(new Date().getTime()));

  useEffect(() => {
    const interval = setInterval(() => setNow(Math.round(new Date().getTime())), 1000);
    return () => clearInterval(interval);
  }, []);

  const startDate = now;
  const endDate = moment(expiresAt);
  const duration = moment.duration(endDate.diff(startDate));
  const exp = +endDate - +startDate;
  const seconds = useMemo(() => (duration.seconds() < 10 ? `0${duration.seconds()}` : duration.seconds()), [duration]);
  const minutes = useMemo(() => (duration.minutes() < 10 ? `0${duration.minutes()}` : duration.minutes()), [duration]);
  return (
    <Text>{exp <= 0 || !expiresAt ? 'Token Expried' : `${minutes}:${seconds}`}</Text>
  );
}
export default CounTime;
