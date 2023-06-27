import React from 'react';
import { Col, Row } from 'antd';
import style from './style.module.less';
import Image from 'next/image';
interface ILineChair{
      dataChair: any;
      handleBoxClick: any;
      selectedBoxes: any
}
function LineChair({dataChair, handleBoxClick, selectedBoxes}:ILineChair) {
  return (
    <Row gutter={[24, 20]} style={{ justifyContent: 'center' }}>
      {dataChair &&
            dataChair.map((item) => {
          if (item?.type_id === 1) {
            return (
              <Col className={style.itemChair} onClick={() => handleBoxClick(item)}>
                {selectedBoxes.includes(item?.id) ? (
                  <Image src='/images/chair/seat-select-normal.png' width={40} height={40} alt='empty chair' />
                ) : (
                  <Image src='/images/NomarlChair.png' width={40} height={40} alt='empty chair' />
                )}
                <p className={style.nameChair}>{item?.name}</p>
              </Col>
            );
          } else if (item?.type_id === 2) {
            return (
              <Col className={style.itemChair} onClick={() => handleBoxClick(item)}>
                {selectedBoxes.includes(item?.id) ? (
                  <Image src='/images/chair/seat-select-vip.png' width={50} height={50} alt='Booking chair' />
                ) : (
                  <Image src='/images/chair/ChairVip.png' width={50} height={50} alt='Booking chair' />
                )}
                <p className={style.nameChair}>{item.name}</p>
              </Col>
            );
          } else if (item?.type_id === 3) {
            return (
              <Col className={style.itemChair} onClick={() => handleBoxClick(item)}>
                {selectedBoxes.includes(item?.id) ? (
                  <Image src='/images/chair/seat-select-double.png' width={50} height={50} alt='Booking chair' />
                ) : (
                  <Image src='/images/chair/doubleChair.png' width={50} height={50} alt='Booking chair' />
                )}
                <p className={style.nameChair}>{item?.name}</p>
              </Col>
            );
          }
        })}
    </Row>
  );
}

export default LineChair;
