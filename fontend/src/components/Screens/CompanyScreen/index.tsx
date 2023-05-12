import React, { useState, useMemo } from 'react';
import { Row, Col, Typography, Button, Breadcrumb, Input, Select, Space, Spin, Affix, Pagination, Form } from 'antd';
import Link from 'next/link';
import { AudioOutlined, SearchOutlined, EllipsisOutlined } from '@ant-design/icons';
import { useTranslation } from 'next-i18next';
import { AiOutlineBars } from 'react-icons/ai';
import { TbGridDots } from 'react-icons/tb';
import { useRouter } from 'next/router';
import Image from 'next/image';

import { queryAllCompany } from '@/queries/hooks/company';
import { baseParams, ListOptionCopmanySize } from '@/configs/const.config';
import ListCompany from '@/components/Elements/ListCompany/ListCompany';
import ListCompanyLine from '@/components/Elements/ListCompanyLine';
import { ELanguage, EOrderBy, IFilter, IOption } from '@/configs/interface.config';
import { GET_LIST_TYPICAL_COMPANY } from '@/queries/keys/company';
import { queryAllCategory } from '@/queries/hooks/categories';
import { queryAllCity } from '@/queries/hooks/countryCity';
import { handleFilter } from '@/libs/const';

import style from './style.module.less';

const suffix = (
  <AudioOutlined
    style={{
      fontSize: 16,
      color: '#1890ff',
    }}
  />
);
const { Title, Paragraph } = Typography;
function CompanyScreen() {
  const [pageCompany, setPageCompany] = useState(1);
  const [show, setShow] = useState(true);
  const [company, setCompany] = useState(true);
  const [params, setParams] = useState<IFilter>();
  const [dataForm, setDataForm] = useState<IFilter>();
  const [form] = Form.useForm();

  const onFinish = (values: IFilter) => {
    setDataForm(values);
    setParams({
      ...params,
      s: values.search,
      city: values.location,
      'categoryIds[]': values.job,
      companySizeTo: values.size,
    });
  };

  const onReset = () => {
    form.resetFields();
  };

  const handleShow = () => {
    setShow((current) => !current);
  };
  const handleChangeCompany = () => {
    setCompany((current) => !current);
  };
  const handleChange = (value: string) => {
    setParams({
      ...params,
      orderBy: handleFilter(value).orderBy as EOrderBy,
      order: handleFilter(value).order,
    });
  };
  const router = useRouter();
  const { t } = useTranslation();
  const { data: listTypicalCompany, isLoading: Loading } = queryAllCompany(
    {
      ...baseParams,
      ...params,
      limit: 15,
      page: pageCompany,
      lang: router.locale as ELanguage,
    },
    GET_LIST_TYPICAL_COMPANY,
  );
  const { data: listCompanyCare } = queryAllCompany(
    {
      limit: 3,
      lang: router.locale as ELanguage,
    },
    GET_LIST_TYPICAL_COMPANY,
  );
  // get LIST CATEGORY
  const { data: listAllCategory } = queryAllCategory({
    ...baseParams,
    limit: -1,
    lang: router.locale as ELanguage,
  });
  const option = useMemo(() => {
    const result: IOption[] = [];
    listAllCategory?.data.forEach((page) => result.push({ value: page._id, label: page.name }));
    return result;
  }, [listAllCategory]);
  // Location
  const { data: listCity } = queryAllCity({
    ...baseParams,
    limit: 0,
    'countryIds[]': '63a97325855ee76033970fe4',
    lang: router.locale as ELanguage,
  });
  const optionCity = useMemo(() => {
    const result: IOption[] = [];
    listCity?.data.forEach((page) => result.push({ value: page._id, label: page.name }));
    return result;
  }, [listCity]);
  const optionSize = useMemo(() => {
    const result: IOption[] = [];
    ListOptionCopmanySize.forEach((page) => result.push({ value: page.value, label: page.label.vi }));
    return result;
  }, [ListOptionCopmanySize]);
  return (
    <div style={{ backgroundColor: '#efe9e9' }}>
      <div className='container'>
        <div className='Company'>
          <Row className={style.company}>
            <Col span={24}>
              <Breadcrumb
                className={style.breadcrumb}
                items={[
                  {
                    title: <Link href='/'>{t('home_page')}</Link>,
                  },
                  {
                    title: 'Danh mục công ty',
                  },
                ]}
              />
            </Col>
            <Col span={24} className={style.CompanyBanner}>
              <Row>
                <Col span={13} className={style.CompanyBannerText}>
                  <Title level={4}>Danh mục công ty</Title>
                  <Paragraph className={style.para}>
                    Khám phá đối tác tiềm năng của bạn trong hơn 3,000+ doanh nghiệp trên iCongty
                  </Paragraph>
                </Col>
              </Row>
            </Col>
            <Col span={24} className={style.CompanyBannerMobie}>
              <Row style={{ width: '100%', height: '100%', margin: 'auto 0' }}>
                <Col span={24} className={style.CompanyBannerTextMobie}>
                  <Title level={4}>Danh mục công ty</Title>
                  <Paragraph className={style.paraMobie}>
                    Khám phá đối tác tiềm năng của bạn trong hơn 3,000+ doanh nghiệp trên iCongty
                  </Paragraph>
                </Col>
              </Row>
            </Col>
            <Col span={24}>
              <Row className={style.searchCompany}>
                <Col span={24}>
                  <Form form={form} name='control-hooks' onFinish={onFinish}>
                    <Row>
                      <Col span={24}>
                        <Form.Item name='search'>
                          <Row gutter={[24, 0]}>
                            <Col xs={15} sm={18} md={19} lg={19}>
                              <Input
                                height={40}
                                placeholder='Nhập tên công ty, mã số thuế, ngành nghề...'
                                suffix={suffix}
                              />
                            </Col>
                            <Col xs={9} sm={6} md={5} lg={5}>
                              <Button
                                className={style.saerchCompany}
                                type='primary'
                                htmlType='submit'
                                icon={<SearchOutlined />}
                              >
                                Tìm kiếm
                              </Button>
                            </Col>
                          </Row>
                        </Form.Item>
                      </Col>
                      <Col span={24}>
                        <Row gutter={[24, 24]}>
                          <Col lg={4}>
                            <Button className={style.searchHigher} onClick={handleShow} icon={<EllipsisOutlined />}>
                              Tìm kiếm nâng cao
                            </Button>
                          </Col>
                          {show ? (
                            <Col sm={24} md={24} lg={20}>
                              <Row gutter={[24, 24]}>
                                <Col xs={24} sm={6}>
                                  <Form.Item name='job'>
                                    <Select defaultValue={t('common:career')} options={option} />
                                  </Form.Item>
                                </Col>
                                <Col xs={24} sm={6}>
                                  <Form.Item name='location'>
                                    <Select defaultValue={t('common:location')} options={optionCity} />
                                  </Form.Item>
                                </Col>
                                <Col xs={24} sm={6}>
                                  <Form.Item name='size'>
                                    <Select defaultValue={t('common:size')} options={optionSize} />
                                  </Form.Item>
                                </Col>
                                <Col xs={24} sm={6}>
                                  <Button onClick={onReset} className={style.deleteCompany}>
                                    Xoá bộ lọc
                                  </Button>
                                </Col>
                              </Row>
                            </Col>
                          ) : null}
                        </Row>
                      </Col>
                    </Row>
                  </Form>
                </Col>
              </Row>
            </Col>
            <Col span={24}>
              <Row className={style.headerCompany}>
                {dataForm && dataForm.search ? (
                  <Space style={{ display: 'flex', flexDirection: 'column', alignItems: 'start' }}>
                    <Title level={3}>Kết quả tìm kiếm</Title>
                    <Paragraph className={style.result}>
                      Tìm thấy <span className={style.light}>{listTypicalCompany?.data.length}</span> kết quả cho
                      <span className={style.light}> &ldquo; {dataForm.search} &ldquo;</span>
                    </Paragraph>
                  </Space>
                ) : (
                  <Title level={3}>
                    Tất cả công ty <span>{listTypicalCompany?.data.length}</span>
                  </Title>
                )}
                <Space className={style.headerSort}>
                  <Space className={style.sortCompany}>
                    <Paragraph
                      style={{ marginBottom: '0', fontSize: '12px', fontFamily: 'SF UI  Text', color: '#595959' }}
                    >
                      {t('news:Sort_by')} :
                    </Paragraph>
                    <Select
                      // value={params?.order === 'ASC' ? `-${params?.orderBy}` : `${params?.orderBy || 'createdAt'}`}
                      className={style.sort}
                      defaultValue='createdAt'
                      style={{ width: 110 }}
                      onChange={handleChange}
                      options={[
                        { value: 'createdAt', label: `${t('news:Latest')}` },
                        { value: '-createdAt', label: `${t('news:Oldest')}` },
                        { value: '-name', label: 'A-Z' },
                        { value: 'name', label: 'Z-A' },
                        { value: 'viewer', label: `${t('news:View')}` },
                      ]}
                    />
                  </Space>
                  <Space>
                    {company ? (
                      <Button onClick={handleChangeCompany} className={`${style.lineCompany} ${style.active}`}>
                        <AiOutlineBars />
                      </Button>
                    ) : (
                      <Button onClick={handleChangeCompany} className={`${style.lineCompany}`}>
                        <AiOutlineBars />
                      </Button>
                    )}
                    {!company ? (
                      <Button onClick={handleChangeCompany} className={`${style.dotCompany} ${style.active}`}>
                        <TbGridDots />
                      </Button>
                    ) : (
                      <Button onClick={handleChangeCompany} className={`${style.dotCompany}`}>
                        <TbGridDots />
                      </Button>
                    )}
                  </Space>
                </Space>
              </Row>
            </Col>
            {!company ? (
              <Col span={24} style={{ paddingTop: '44px' }}>
                {Loading ? (
                  <Spin />
                ) : (
                  <Row gutter={[26, 32]}>
                    {listTypicalCompany?.data &&
                      listTypicalCompany?.data.map((item) => <ListCompany listTypicalCompany={item} />)}
                    {listTypicalCompany?.data && listTypicalCompany?.data.length === 0 && (
                      <Col>
                        <Row style={{ textAlign: 'center' }}>
                          <Col span={24} className={style.imgErr}>
                            <Image src='/images/Frame (13).png' width={668} height={480} alt='no data' />
                          </Col>
                          <Col span={24}>
                            <Title className={style.noResult} level={5}>
                              Không có kết quả phù hợp với kết quả tìm kiếm của bạn
                            </Title>
                          </Col>
                          <Col span={24}>
                            <Paragraph className={style.noResultPara}>
                              Hãy sử dụng một từ khóa hoặc tiêu chí lọc khác
                            </Paragraph>
                          </Col>
                        </Row>
                        <Row>
                          <Col span={24}>
                            <Title level={4} className={style.care}>
                              Có thể bạn quan tâm
                            </Title>
                          </Col>
                          <Col span={24}>
                            <Row gutter={[24, 24]}>
                              {listCompanyCare?.data.map((item) => (
                                <ListCompany listTypicalCompany={item} />
                              ))}
                            </Row>
                          </Col>
                        </Row>
                      </Col>
                    )}
                  </Row>
                )}
              </Col>
            ) : (
              ''
            )}
            {company ? (
              <Col span={24}>
                <Affix offsetTop={48}>
                  <Row className={style.TitleCompany}>
                    <Col sm={16} md={14} lg={12}>
                      <strong>Doanh nghiệp</strong>
                    </Col>
                    <Col lg={4}>
                      <strong>Mã số thuế</strong>
                    </Col>
                    <Col md={5} lg={4}>
                      <strong>Ngành nghề</strong>
                    </Col>
                    <Col sm={8} md={5} lg={4}>
                      <strong>Địa điểm</strong>
                    </Col>
                  </Row>
                </Affix>
                <Row gutter={[0, 24]}>
                  {listTypicalCompany?.data &&
                    listTypicalCompany?.data.map((item) => (
                      <Col span={24}>
                        <ListCompanyLine listCompanyLine={item} />
                      </Col>
                    ))}
                  {listTypicalCompany?.data && listTypicalCompany?.data.length === 0 && (
                    <Col>
                      <Row style={{ textAlign: 'center' }}>
                        <Col span={24} className={style.imgErr}>
                          <Image src='/images/Frame (13).png' width={668} height={480} alt='no data' />
                        </Col>
                        <Col span={24}>
                          <Title className={style.noResult} level={5}>
                            Không có kết quả phù hợp với kết quả tìm kiếm của bạn
                          </Title>
                        </Col>
                        <Col span={24}>
                          <Paragraph className={style.noResultPara}>
                            Hãy sử dụng một từ khóa hoặc tiêu chí lọc khác
                          </Paragraph>
                        </Col>
                      </Row>
                      <Row>
                        <Col span={24}>
                          <Title level={4} className={style.care}>
                            Có thể bạn quan tâm
                          </Title>
                        </Col>
                        <Col span={24}>
                          <Row gutter={[24, 24]}>
                            {listCompanyCare?.data.map((item) => (
                              <ListCompany listTypicalCompany={item} />
                            ))}
                          </Row>
                        </Col>
                      </Row>
                    </Col>
                  )}
                </Row>
              </Col>
            ) : (
              ''
            )}
            <Col span={24} style={{ display: 'flex', justifyContent: 'center', paddingTop: '32px' }}>
              <Row>
                <Col>
                  <Pagination
                    onChange={(page) => setPageCompany(page)}
                    current={pageCompany || 1}
                    hideOnSinglePage
                    defaultCurrent={1}
                    total={Math.ceil(((listTypicalCompany?.total || 0) * 10) / 9)}
                  />
                </Col>
              </Row>
            </Col>
          </Row>
        </div>
      </div>
    </div>
  );
}

export default CompanyScreen;
