<?php

namespace Iverve\Categoryonhome\Block;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Reports\Block\Product\Viewed as ReportProductViewed;
//use Mageplaza\Productslider\Helper\Data;
/**
 * Class RecentProducts
 * @package Mageplaza\Productslider\Block
 */
class RecentProducts extends AbstractSlider
{
    /**
     * @var ReportProductViewed
     */
    protected $reportProductViewed;
    /**
     * RecentProducts constructor.
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     * @param Visibility $catalogProductVisibility
     * @param DateTime $dateTime
     * @param Data $helperData
     * @param HttpContext $httpContext
     * @param ReportProductViewed $reportProductViewed
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        Visibility $catalogProductVisibility,
        DateTime $dateTime,
        Data $helperData,
        HttpContext $httpContext,
        ReportProductViewed $reportProductViewed,
        array $data = []
    ) {
        $this->reportProductViewed = $reportProductViewed;
        parent::__construct($context, $productCollectionFactory, $catalogProductVisibility, $dateTime, $helperData, $httpContext, $data);
    }
    /**
     * Get Collection Recently Viewed product
     * @return mixed
     */
    public function getProductCollection()
    {
        return $this->reportProductViewed->getItemsCollection()->setPageSize($this->getProductsCount());
    }
}