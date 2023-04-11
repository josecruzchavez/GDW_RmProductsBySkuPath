<?php
namespace GDW\RmProductsBySkuPath\Console\Command;

use Magento\Framework\Registry;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use GDW\Core\Helper\Data as GdwHelper;
use Magento\Catalog\Model\ProductRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;


 
class RemoveProducts extends Command
{
    const PATH = 'path';
    const LIMIT = 500;

    public function __construct(
        State $state,
        Registry $registry,
        GdwHelper $gdwHelper,
        ProductRepository $productRepository,
        CollectionFactory $productCollectionFactory, 
        $name = null
    ) {
        parent::__construct($name);
        $this->state = $state;
        $this->registry = $registry;
        $this->gdwHelper = $gdwHelper;
        $this->productRepository = $productRepository;
        $this->productCollectionFactory = $productCollectionFactory;    
    }

    protected function configure()
    {
       $commandoptions = [new InputOption(self::PATH, null, InputOption::VALUE_REQUIRED, 'path')];

       $this->setName('gdw:rmproductsbysku');
       $this->setDescription('Remove all products where value %like% in sku');
       $this->setDefinition($commandoptions);    
       parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $limit = self::LIMIT;
        $this->registry->register('isSecureArea', true, true);

        try {
            $this->state->getAreaCode();
        }catch (\Exception $e) {
            $this->state->setAreaCode(Area::AREA_ADMINHTML);
        }
       
        $filter = $input->getOption(self::PATH);

        if ($filter){
            $products = $this->getProductCollection($filter);
            if($products->getSize() > 0){
                $limit = $products->getSize();
                $output->writeln('<fg=blue>'.$products->getSize().' Products.</>');
                if($products->getSize() >= self::LIMIT){
                    $limit = self::LIMIT;
                    $output->writeln('<fg=blue>Only process '.self::LIMIT.' products, run command again after this turn.</>');
                }
                
                $question = new ConfirmationQuestion('Continue with this action ? (y/n): ', false);
                $helper = $this->getHelper('question');
                $ans = $helper->ask($input, $output, $question);

                if ($ans == 'y' || $ans == 'yes') {
                    $progressBar = new ProgressBar($output, $limit);
                    $progressBar->start();
                        foreach($products as $product){
                            $this->processRemove($product);
                            $progressBar->advance();
                        }
                    $progressBar->finish();
                    $output->writeln('');
                    $this->gdwHelper->log('Finished process.');
                }else{
                    $output->writeln('<fg=red>Stop Script.</>');
                }
            }else{
                $output->writeln('<fg=red>No matches were found for the placed %like%.</>');
            }
        }else{
            $output->writeln('<fg=red>Pattern is needed (--path).</>');
        }
    }

    public function getProductCollection($filter)
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('sku', ['like' => '%'.$filter.'%']);
        if($collection->getSize() > 0 && $collection->getSize() >= self::LIMIT){
            $collection->setPageSize(self::LIMIT)->setCurPage(1);
        }
        return $collection;
    }

    public function processRemove($product)
    {
        try {
            $sku = $product->getSku(); 
            if($product->delete()){
                $this->gdwHelper->log('SKU: "'.$sku.'" delected.','GDW_RmProductsBySkuPath.log');
            }
        } catch (\Throwable $th) {
            $this->gdwHelper->log($th,'GDW_RmProductsBySkuPath.log');
            echo $th;
            return false;
        }
        return true;
    }
}