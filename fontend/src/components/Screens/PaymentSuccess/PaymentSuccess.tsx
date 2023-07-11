import { Button, Col, Row } from 'antd';
import Image from 'next/image';
import React from 'react'
import { MdOutlineDownloadDone } from 'react-icons/md';
import style from './style.module.less'
function PaymentSuccess() {
  return (
    <Row className={style.success}>
      <Col span={24} className={style.top}>
            <Image src='/images/CashSuccess.gif' width={500} height={300} alt='img'/>
      </Col>
      <Col span={24} className={style.bottom}>
            <Row style={{textAlign: 'center'}}>
                  <Col span={24}>
                        <h1>Thank you !</h1>
                  </Col>
                  <Col span={24} className={style.successPayment}>
                        <span><MdOutlineDownloadDone /></span><p>Thanh toán thành công</p>
                  </Col>
                  <Col span={24} className={style.thank}>
                        <p>Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi, Mong rằng bạn sẽ có trải nghiệm tốt cùng gia đình và bạn bè</p>
                  </Col>
                  <Col span={24} className={style.button}>
                        <Button href='/'>Back to home</Button>
                  </Col>
            </Row>
      </Col>
    </Row>
  )
}

export default PaymentSuccess;