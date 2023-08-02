import React, { useEffect, useState } from 'react';
import { Col, Modal, Row, Spin } from 'antd';
import style from './style.module.less';
import Image from 'next/image';
interface ILineChair {
  dataChair: any;
  handleBoxClick: any;
  selectedBoxes: any;
  isError: any;
  refetch: any;
  isLoading: any;
}
function LineChair({ dataChair, handleBoxClick, selectedBoxes, isError, refetch, isLoading }: ILineChair) {
  useEffect(() => {
    if (isError) {
      setIsModalOpen(true);
    }
  }, [isError]);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const handleSelectChair = (item:any) =>{
      if(!isLoading){
            handleBoxClick(item)
      }
  }
  const showModal = () => {
    setIsModalOpen(true);
  };

  const handleOk = () => {
    setIsModalOpen(false);
    refetch();
  };
  return (
    <Row gutter={[33, 0]} style={{ flexWrap: 'nowrap', paddingBottom: '10px' }}>
      {dataChair &&
        dataChair.map((item: any) => {
          if (item?.type_id === 1) {
            if (item?.status === 1) {
              return (
                <Col className={style.itemChair}>
                  <div onClick={showModal}>
                    <Image src='/images/chair/seat-process-normal.png' width={50} height={50} alt='empty chair' />
                    <p className={style.nameChair}>{item?.name}</p>
                  </div>
                  <Modal title='Đăt lại ghế' open={isModalOpen} onOk={handleOk}>
                    <p>Ghế đã có người đặt vui lòng đặt lại</p>
                  </Modal>
                </Col>
              );
            } else if (item?.status === 2) {
              return (
                <Col className={style.itemChair}>
                  <Image src='/images/chair/seat-buy-normal.png' width={50} height={50} alt='Booking chair' />
                  <p className={style.nameChair}>{item?.name}</p>
                </Col>
              );
            } else {
              return (
                <Col className={style.itemChair} onClick={() => handleSelectChair(item)}>
                  {selectedBoxes.includes(item) || item?.status === 1 ? (
                    <Image src='/images/chair/seat-select-normal.png' width={50} height={50} alt='empty chair' />
                  ) : (
                    <Image src='/images/NomarlChair.png' width={50} height={50} alt='empty chair' />
                  )}
                  {!isLoading ? (
                        <p className={style.nameChair}>{item?.name}</p>
                      ) : (
                        <div className={style.nameChair}>
                              <Spin />
                        </div>
                      )}
                </Col>
              );
            }
          } else if (item?.type_id === 2) {
            if (item?.status === 1) {
              return (
                <Col className={style.itemChair}>
                  <div onClick={showModal}>
                    <Image src='/images/chair/seat-process-vip.png' width={50} height={50} alt='empty chair' />
                    <p className={style.nameChair}>{item?.name}</p>
                  </div>
                  <Modal title='Đăt lại ghế' open={isModalOpen} onOk={handleOk}>
                    <p>Ghế đã có người đặt vui lòng đặt lại</p>
                  </Modal>
                </Col>
              );
            } else if (item?.status === 2) {
              return (
                <Col className={style.itemChair}>
                  <Image src='/images/chair/seat-buy-vip.png' width={50} height={50} alt='Booking chair' />
                  <p className={style.nameChair}>{item?.name}</p>
                </Col>
              );
            } else {
              return (
                <Col className={style.itemChair} onClick={() => handleSelectChair(item)}>
                  {selectedBoxes.includes(item) || item?.status === 1 ? (
                    <Image src='/images/chair/seat-select-vip.png' width={50} height={50} alt='empty chair' />
                  ) : (
                        <Image src='/images/chair/ChairVip.png' width={50} height={50} alt='empty chair' />
                  )}
                  {!isLoading ? (
                        <p className={style.nameChair}>{item?.name}</p>
                      ) : (
                        <div style={{cursor: 'no-drop'}} className={style.nameChair}>
                              <Spin />
                        </div>
                      )}
                </Col>
              );
            }
          } else if (item?.type_id === 3) {
            if (item?.status === 1) {
              return (
                <Col className={style.itemChair}>
                  <div onClick={showModal}>
                    <Image src='/images/chair/seat-process-double.png' width={50} height={50} alt='empty chair' />
                    <p className={style.nameChair}>{item?.name}</p>
                  </div>
                  <Modal title='Đăt lại ghế' open={isModalOpen} onOk={handleOk}>
                    <p>Ghế đã có người đặt vui lòng đặt lại</p>
                  </Modal>
                </Col>
              );
            } else if (item?.status === 2) {
              return (
                <Col className={style.itemChair}>
                  <Image src='/images/chair/seat-buy-double.png' width={50} height={50} alt='Booking chair' />
                  <p className={style.nameChair}>{item?.name}</p>
                </Col>
              );
            } else {
              return (
                <Col className={style.itemChair} onClick={() => handleSelectChair(item)}>
                  {selectedBoxes.includes(item) ? (
                    <Image src='/images/chair/seat-select-double.png' width={50} height={50} alt='Booking chair' />
                  ) : (
                    <div>
                          <Image src='/images/chair/doubleChair.png' width={50} height={50} alt='Booking chair' />
                    </div>
                  )}
                  {!isLoading ? (
                        <p className={style.nameChair}>{item?.name}</p>
                      ) : (
                        <div className={style.nameChair}>
                              <Spin />
                        </div>
                      )}
                </Col>
              );
            }
          }
        })}
    </Row>
  );
}

export default LineChair;
