<?php

declare(strict_types=1);

namespace WirelessLogic\Tests\Unit;

class PageScraperTest extends \PHPUnit\Framework\TestCase
{
    public function dataProvider()
    {
        return [
            [
                '<div class="col-xs-4">
                    <div class="package featured center" style="margin-left:0px;">
                        <div class="header dark-bg">
                            <h3>Standard: 1GB Data - 12 Months</h3>
                        </div>
                        <div class="package-features">
                            <ul>
                                <li>
                                    <div class="package-name">The standard subscription providing you with enough service time to support the average user to enable your device to be up and running with inclusive Data and SMS services.</div>
                                </li>
                                <li>
                                    <div class="package-description">Up to 1 GB data per month<br>including 35 SMS<br>(5p / MB data and 4p / SMS thereafter)</div>
                                </li>
                                <li>
                                    <div class="package-price"><span class="price-big">£9.99</span><br>(inc. VAT)<br>Per Month</div>
                                </li>
                                <li>
                                    <div class="package-data">12 Months - Data &amp; SMS Service Only</div>
                                </li>
                            </ul>
                            <div class="bottom-row">
                                <a class="btn btn-primary main-action-button" href="https://wltest.dns-systems.net/" role="button">Choose</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="package featured center" style="margin-left:0px;">
                        <div class="header dark-bg">
                            <h3>Standard: 12GB Data - 1 Year</h3>
                        </div>
                        <div class="package-features">
                            <ul>
                                <li>
                                    <div class="package-name">The standard subscription providing you with enough service time to support the average user with Data and SMS services to allow access to your device.</div>
                                </li>
                                <li>
                                    <div class="package-description">Up to 12GB of data per year<br> including 420 SMS<br>(5p / MB data and 4p / SMS thereafter)</div>
                                </li>
                                <li>
                                    <div class="package-price"><span class="price-big">£108.00</span><br>(inc. VAT)<br>Per Year
                                       <p style="color: red">Save £11.90 on the monthly price</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="package-data">Annual - Data &amp; SMS Service Only</div>
                                </li>
                            </ul>
                            <div class="bottom-row">
                                <a class="btn btn-primary main-action-button" href="https://wltest.dns-systems.net/#" role="button">Choose</a>
                            </div>
                        </div>
                    </div>
                </div>',
                '{"[[\"title\" ":" \"Standard: 1GB Data - 12 Months","description\" ":" \"The standard subscription providing you with enough service time to support the average user with Data and SMS services to allow access to your device.","price\" ":" \"\u00a3108.00 (inc. VAT) Per Year","discount\" ":" \"\u00a311.90\/month\"]]","[\"title\" ":" \"Standard: 12GB Data - 1 Year"}'

            ]
        ];
    }

    /**
     * @test
     */
    public function itShould_scrapePageFromUrlAndReturnJsonData($html, $json)
    {
        $crawler = $this->createMock(Crawler::class);

        $scraper = $this->getMockBuilder(HtmlScraper::class)
            ->setConstructorArgs([$crawler])
            // ->onlyMethods([''])
            ->getMock();

        $formatter = $this->createMock(JsonFormatter::class);

        // $crawler->expects(%this->once())
        //     ->method('');

        $scraper->expects($this->once())
            ->method('scrape')
            ->with($url = 'https://somefakeurl.com')
            ->willReturn($json);

        $scraper->expects($this->once())
            ->method('scrape')
            ->with($url = 'https://somefakeurl.com')
            ->willReturn($json);

        $mediator = new HtmlToJsonMediator($scraper, $formatter);




        $mediator->getJsonData($url);
    }
}
