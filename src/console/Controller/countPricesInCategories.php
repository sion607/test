<?php

namespace App\console\Controller;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'console:count-prices-in-categories',
    description: 'Count total in each category',
    hidden: false
)]
class countPricesInCategories extends Command
{
    private const ITEM = 1;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pricesByCategory = [];
        $url = file_get_contents('https://fakestoreapi.com/products');
        $itemsArray = json_decode($url, true);

        foreach ($itemsArray as $item) {
            $pricesByCategory[$item['category']] = [
                'category_name' => $item['category'],
                'total' => isset($pricesByCategory[$item['category']]['total'])
                    ? $item['price'] + $pricesByCategory[$item['category']]['total']
                    : $item['price'],
                'items' => isset($pricesByCategory[$item['category']]['items'])
                    ? $pricesByCategory[$item['category']]['items'] + self::ITEM
                    : self::ITEM
            ];
        }

        foreach ($pricesByCategory as $price) {
            $output->writeln(
                $price['category_name'] .
                ' - ' .
                round($price['total'], 2)
            );
        }

        return self::SUCCESS;
    }

    private function indexBy(string $categoryName, mixed $itemsArray): array
    {
        $newArray = [];
        foreach ($itemsArray as $id => $item) {
            if ($item[$categoryName]) {
                $newArray[$item[$categoryName] . '_' . $id] = $item;
            }
        }
        return $newArray;
    }
}