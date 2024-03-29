<?php
namespace Iverve\Categoryonhome\Block;
 
class Category extends \Magento\Framework\View\Element\Template
{
     protected $_categoryHelper;
     protected $categoryFlatConfig;
     protected $topMenu;
	 protected $product; 
	 protected $recentlyViewed;
	 const ORDER_LIMIT = 8;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Helper\Category $categoryHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState,
        \Magento\Theme\Block\Html\Topmenu $topMenu,
		\Magento\Catalog\Model\ProductFactory $product,
		\Magento\Reports\Block\Product\Viewed $recentlyViewed,
        array $data = []
	
    ) {
        $this->_categoryHelper = $categoryHelper;
        $this->categoryFlatConfig = $categoryFlatState;
        $this->topMenu = $topMenu;
		$this->product = $product;
		$this->recentlyViewed = $recentlyViewed;
        parent::__construct( $context, $data );
        //parent::__construct($context);
    }
    /**
     * Return categories helper
     */   
    public function getCategoryHelper()
    {
        return $this->_categoryHelper;
    }
    /**
     * Return top menu html
     * getHtml($outermostClass = '', $childrenWrapClass = '', $limit = 0)
     * example getHtml('level-top', 'submenu', 0)
     */   
    public function getHtml()
    {
        return $this->topMenu->getHtml();
    }
    /**
     * Retrieve current store categories
     *
     * @param bool|string $sorted
     * @param bool $asCollection
     * @param bool $toLoad
     * @return \Magento\Framework\Data\Tree\Node\Collection|\Magento\Catalog\Model\Resource\Category\Collection|array
     */    
   public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted , $asCollection, $toLoad);
    }
    /**
     * Retrieve child store categories
     *
     */ 
    public function getChildCategories($category)
    {
           if ($this->categoryFlatConfig->isFlatEnabled() && $category->getUseFlatResource()) {
                $subcategories = (array)$category->getChildrenNodes();
            } else {
                $subcategories = $category->getChildren();
            }
            return $subcategories;
    }
	public function getProduct($id)
    {
        return $this->product->create()->load($id);
    }
	public function getMostRecentlyViewed(){
        return $this->recentlyViewed->getItemsCollection()->setPageSize(self::ORDER_LIMIT)->getData();
    }
}