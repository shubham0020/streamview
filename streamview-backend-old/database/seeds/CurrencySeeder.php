<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('currencies')->count() > 0) {
            return;
        }
           
        DB::table('currencies')->insert([
            
            ['currency_code' =>'AED', 'currency_name' =>'United Arab Emirates Dirham',   'currency' =>'د.إ'], 
            ['currency_code' =>'AFN', 'currency_name' =>'Afghanistani Afghani',   'currency' =>'؋'], 
            ['currency_code' =>'ALL', 'currency_name' =>'Albanian Lek',   'currency' =>'Lek'], 
            ['currency_code' =>'AMD', 'currency_name' =>'Armenian Dram',   'currency' =>'դր'], 
            ['currency_code' =>'ANG', 'currency_name' =>'Netherlands Antillean Guilder',   'currency' =>'NAf'], 
            ['currency_code' =>'AOA', 'currency_name' =>'Angolan Kwanza',   'currency' =>'Kz'], 
            ['currency_code' =>'ARS', 'currency_name' =>'Argentine Peso',   'currency' =>'$'], 
            ['currency_code' =>'AUD', 'currency_name' =>'Australian Dollar',   'currency' =>'$'], 
            ['currency_code' =>'AWG', 'currency_name' =>'Aruban Florin',   'currency' =>'ƒ'], 
            ['currency_code' =>'AZN', 'currency_name' =>'Azerbaijani Manat',   'currency' =>'₼'], 
            ['currency_code' =>'BAM', 'currency_name' =>'Bosnia-Herzegovina Convertible Mark',   'currency' =>'KM'], 
            ['currency_code' =>'BBD', 'currency_name' =>'Barbados Dollar',   'currency' =>'$'], 
            ['currency_code' =>'BDT', 'currency_name' =>'Bangladeshi Taka',   'currency' =>'৳'], 
            ['currency_code' =>'BGN', 'currency_name' =>'Bulgarian Lev',   'currency' =>'лв'], 
            ['currency_code' =>'BIF', 'currency_name' =>'Burundian Franc',   'currency' =>'FBu'], 
            ['currency_code' =>'BMD', 'currency_name' =>'Bermuda Dollar',   'currency' =>'$'], 
            ['currency_code' =>'BND', 'currency_name' =>'Brunei Dollar',   'currency' =>'$'], 
            ['currency_code' =>'BOB', 'currency_name' =>'Bolivian Boliviano',   'currency' =>'$b'], 
            ['currency_code' =>'BRL', 'currency_name' =>'Brazilian Real',   'currency' =>'R$'], 
            ['currency_code' =>'BSD', 'currency_name' =>'Bahamian Dollar',   'currency' =>'$'],  
            ['currency_code' =>'BWP', 'currency_name' =>'Botswana Pula',   'currency' =>'P'], 
            ['currency_code' =>'BZD', 'currency_name' =>'Belize Dollar',   'currency' =>'BZ$'], 
            ['currency_code' =>'CAD', 'currency_name' =>'Canadian Dollar',   'currency' =>'$'], 
            ['currency_code' =>'CDF', 'currency_name' =>'Congolese franc',   'currency' =>'FC'], 
            ['currency_code' =>'CHF', 'currency_name' =>'Swiss Franc',   'currency' =>'CHF'], 
            ['currency_code' =>'CLP', 'currency_name' =>'Chilean Peso',   'currency' =>'$'], 
            ['currency_code' =>'CNY', 'currency_name' =>'Chinese Yuan Renminbi',   'currency' =>'¥'], 
            ['currency_code' =>'COP', 'currency_name' =>'Colombian Peso',   'currency' =>'$'], 
            ['currency_code' =>'CUC', 'currency_name' =>'Cuban Convertible Peso',   'currency' =>'$'], 
            ['currency_code' =>'CVE', 'currency_name' =>'Cape Verde Escudo',   'currency' =>'$'], 
            ['currency_code' =>'CZK', 'currency_name' =>'Czech Koruna',   'currency' =>'Kč'], 
            ['currency_code' =>'DJF', 'currency_name' =>'Djiboutian Franc',   'currency' =>'Fdj'], 
            ['currency_code' =>'DKK', 'currency_name' =>'Danish Krone',   'currency' =>'kr.'], 
            ['currency_code' =>'DOP', 'currency_name' =>'Dominican Peso',   'currency' =>'RD$'], 
            ['currency_code' =>'DZD', 'currency_name' =>'Algerian Dinar',   'currency' =>'دج'], 
            ['currency_code' =>'EGP', 'currency_name' =>'Egyptian Pound',   'currency' =>'£'], 
            ['currency_code' =>'ETB', 'currency_name' =>'Ethiopian Birr',   'currency' =>'ብር'], 
            ['currency_code' =>'EUR', 'currency_name' =>'European Euro',   'currency' =>'€'], 
            ['currency_code' =>'FKP', 'currency_name' =>'Falkland Islands Pound',   'currency' =>'£'], 
            ['currency_code' =>'FJD', 'currency_name' =>'Fiji Dollar',   'currency' =>'$'], 
            ['currency_code' =>'GBP', 'currency_name' =>'United Kingdom Pound Sterling',   'currency' =>'£'], 
            ['currency_code' =>'GEL', 'currency_name' =>'Georgian Lari',   'currency' =>'ლ'],
            ['currency_code' =>'GIP', 'currency_name' =>'Gibraltar Pound',   'currency' =>'£'], 
            ['currency_code' =>'GMD', 'currency_name' =>'Gambian Dalasi',   'currency' =>'D'], 
            ['currency_code' =>'GNF', 'currency_name' =>'Guinean Franc',   'currency' =>'FG'], 
            ['currency_code' =>'GTQ', 'currency_name' =>'Guatemalan Quetzal',   'currency' =>'Q'], 
            ['currency_code' =>'GYD', 'currency_name' =>'Guyanese Dollar',   'currency' =>'$'], 
            ['currency_code' =>'HKD', 'currency_name' =>'Hong Kong Dollar',   'currency' =>'HK$'], 
            ['currency_code' =>'HNL', 'currency_name' =>'Honduran Lempira',   'currency' =>'L'], 
            ['currency_code' =>'HRK', 'currency_name' =>'Croatian Kuna',   'currency' =>'kn'], 
            ['currency_code' =>'HTG', 'currency_name' =>'Haitian Gourde',   'currency' =>'G'], 
            ['currency_code' =>'HUF', 'currency_name' =>'Hungarian Forint',   'currency' =>'Ft'], 
            ['currency_code' =>'IDR', 'currency_name' =>'Indonesian Rupiah',   'currency' =>'Rp'], 
            ['currency_code' =>'ILS', 'currency_name' =>'Israeli New Sheqel',   'currency' =>'₪'], 
            ['currency_code' =>'INR', 'currency_name' =>'Indian Rupee',   'currency' =>'₹'], 
            ['currency_code' =>'ISK', 'currency_name' =>'Icelandic Krona',   'currency' =>'kr'], 
            ['currency_code' =>'JMD', 'currency_name' =>'Jamaican Dollar',   'currency' =>'J$'], 
            ['currency_code' =>'JPY', 'currency_name' =>'Japanese Yen',   'currency' =>'¥'], 
            ['currency_code' =>'KES', 'currency_name' =>'Kenyan Shilling',   'currency' =>'KSh,'], 
            ['currency_code' =>'KGS', 'currency_name' =>'Kyrgyzstani Som',   'currency' =>'лв'], 
            ['currency_code' =>'KHR', 'currency_name' =>'Cambodian Riel',   'currency' =>'៛'], 
            ['currency_code' =>'KMF', 'currency_name' =>'Comorian Franc',   'currency' =>'CF'], 
            ['currency_code' =>'KRW', 'currency_name' =>'Korean Won',   'currency' =>'₩'], 
            ['currency_code' =>'KYD', 'currency_name' =>'Cayman Islands Dollar',   'currency' =>'$'],
            ['currency_code' =>'KZT', 'currency_name' =>'Kazakhstani Tenge',   'currency' =>'лв'], 
            ['currency_code' =>'LAK', 'currency_name' =>'Lao Kip',   'currency' =>'₭'], 
            ['currency_code' =>'LBP', 'currency_name' =>'Lebanese Pound',   'currency' =>'£'], 
            ['currency_code' =>'LKR', 'currency_name' =>'Sri Lankan Rupee',   'currency' =>'₨'], 
            ['currency_code' =>'LRD', 'currency_name' =>'Liberian Dollar',   'currency' =>'$'], 
            ['currency_code' =>'LSL', 'currency_name' =>'Lesotho Loti',   'currency' =>'L'], 
            ['currency_code' =>'MAD', 'currency_name' =>'Moroccan Dirham',   'currency' =>'DH'], 
            ['currency_code' =>'MDL', 'currency_name' =>'Moldovan Leu',   'currency' =>'L'], 
            ['currency_code' =>'MGA', 'currency_name' =>'Malagasy Ariary',   'currency' =>'Ar'], 
            ['currency_code' =>'MKD', 'currency_name' =>'Macedonian Denar',   'currency' =>'ден'], 
            ['currency_code' =>'MMK', 'currency_name' =>'Myanmar Kyat',   'currency' =>'K'], 
            ['currency_code' =>'MNT', 'currency_name' =>'Mongolian Tugrik',   'currency' =>'₮'], 
            ['currency_code' =>'MOP', 'currency_name' =>'Macanese Pataca',   'currency' =>'MOP$'], 
            ['currency_code' =>'MRO', 'currency_name' =>'Mauritanian Ouguiya',   'currency' =>'UM'],
            ['currency_code' =>'MUR', 'currency_name' =>'Mauritian Rupee',   'currency' =>'₨'], 
            ['currency_code' =>'MVR', 'currency_name' =>'Maldives Rufiyaa',   'currency' =>'Rf'], 
            ['currency_code' =>'MWK', 'currency_name' =>'Malawian Kwacha',   'currency' =>'MK'], 
            ['currency_code' =>'MXN', 'currency_name' =>'Mexican Peso',   'currency' =>'$'], 
            ['currency_code' =>'MYR', 'currency_name' =>'Malaysian Ringgit',   'currency' =>'RM'], 
            ['currency_code' =>'MZN', 'currency_name' =>'Mozambican Metical',   'currency' =>'MT'], 
            ['currency_code' =>'NAD', 'currency_name' =>'Namibian Dollar',   'currency' =>'$'], 
            ['currency_code' =>'NGN', 'currency_name' =>'Nigerian Naira',   'currency' =>'₦'], 
            ['currency_code' =>'NIO', 'currency_name' =>'Nicaraguan Córdoba',   'currency' =>'C$'], 
            ['currency_code' =>'NOK', 'currency_name' =>'Norwegian Krone',   'currency' =>'kr'], 
            ['currency_code' =>'NPR', 'currency_name' =>'Nepalese Rupee',   'currency' =>'₨'], 
            ['currency_code' =>'NZD', 'currency_name' =>'New Zealand Dollar',   'currency' =>'$'], 
            ['currency_code' =>'PAB', 'currency_name' =>'Panamanian Balboa',   'currency' =>'B/.'], 
            ['currency_code' =>'PEN', 'currency_name' =>'Peruvian Nuevo Sol',   'currency' =>'S/.'], 
            ['currency_code' =>'PGK', 'currency_name' =>'Papua New Guinea Kina',   'currency' =>'K'], 
            ['currency_code' =>'PHP', 'currency_name' =>'Philippine Peso',   'currency' =>'₱'], 
            ['currency_code' =>'PKR', 'currency_name' =>'Pakistan Rupee',   'currency' =>'₨'], 
            ['currency_code' =>'PLN', 'currency_name' =>'Polish Zloty',   'currency' =>'zł'], 
            ['currency_code' =>'PYG', 'currency_name' =>'Paraguay Guarani',   'currency' =>'Gs'], 
            ['currency_code' =>'QAR', 'currency_name' =>'Qatari Riyal',   'currency' =>'﷼'], 
            ['currency_code' =>'RON', 'currency_name' =>'Romanian Leu',   'currency' =>'lei'], 
            ['currency_code' =>'RSD', 'currency_name' =>'Serbian Dinar',   'currency' =>'Дин.'], 
            ['currency_code' =>'RUB', 'currency_name' =>'Russian Ruble',   'currency' =>'₽'], 
            ['currency_code' =>'RWF', 'currency_name' =>'Rwandan Franc',   'currency' =>'FRw'], 
            ['currency_code' =>'SAR', 'currency_name' =>'Saudi Arabian Riyal',   'currency' =>'﷼'], 
            ['currency_code' =>'SBD', 'currency_name' =>'Solomon Islands Dollar',   'currency' =>'$'], 
            ['currency_code' =>'SCR', 'currency_name' =>'Seychelles Rupee',   'currency' =>'₨'], 
            ['currency_code' =>'SEK', 'currency_name' =>'Swedish Krona',   'currency' =>'kr'], 
            ['currency_code' =>'SGD', 'currency_name' =>'Singapore Dollar',   'currency' =>'$'],
            ['currency_code' =>'SHP', 'currency_name' =>'Saint Helena Pound',   'currency' =>'£'],
            ['currency_code' =>'SLL', 'currency_name' =>'Sierra Leonean Leone',   'currency' =>'Le'], 
            ['currency_code' =>'SOS', 'currency_name' =>'Somali Shilling',   'currency' =>'S'], 
            ['currency_code' =>'SRD', 'currency_name' =>'Suriname Dollar',   'currency' =>'$'], 
            ['currency_code' =>'STD', 'currency_name' =>'Sao Tome Dobra',   'currency' =>'Db'], 
            ['currency_code' =>'SZL', 'currency_name' =>'Swazi Lilangeni',   'currency' =>'E'], 
            ['currency_code' =>'THB', 'currency_name' =>'Thai Baht',   'currency' =>'฿'], 
            ['currency_code' =>'TJS', 'currency_name' =>'Tajikistan Somoni',   'currency' =>'ЅM'], 
            ['currency_code' =>'TOP', 'currency_name' =>'Tongan Pa Anga',   'currency' =>'T$'], 
            ['currency_code' =>'TRY', 'currency_name' =>'Turkish New Lira',   'currency' =>'₺'], 
            ['currency_code' =>'TTD', 'currency_name' =>'Trinidad and Tobago Dollar',   'currency' =>'TT$'], 
            ['currency_code' =>'TWD', 'currency_name' =>'New Taiwan Dollar',   'currency' =>'NT$'], 
            ['currency_code' =>'TZS', 'currency_name' =>'Tanzanian Shilling',   'currency' =>'TSh'], 
            ['currency_code' =>'UAH', 'currency_name' =>'Ukrainian Hryvnia',   'currency' =>'₴'], 
            ['currency_code' =>'UGX', 'currency_name' =>'Ugandan Shilling',   'currency' =>'USh'], 
            ['currency_code' =>'USD', 'currency_name' =>'United States Dollar',   'currency' =>'$'], 
            ['currency_code' =>'UYU', 'currency_name' =>'Uruguayan peso',   'currency' =>'$U'], 
            ['currency_code' =>'UZS', 'currency_name' =>'Uzbekistani Som',   'currency' =>'лв'],
            ['currency_code' =>'VND', 'currency_name' =>'Viet Nam Dong',   'currency' =>'₫'],
            ['currency_code' =>'VUV', 'currency_name' =>'Vanuatu vatu',   'currency' =>'VT'],
            ['currency_code' =>'WST', 'currency_name' =>'Samoan Tala',   'currency' =>'WS$'], 
            ['currency_code' =>'XAF', 'currency_name' =>'Central African CFA',   'currency' =>'FCFA'], 
            ['currency_code' =>'XCD', 'currency_name' =>'East Caribbean Dollar',   'currency' =>'$'], 
            ['currency_code' =>'XOF', 'currency_name' =>'West African CFA',   'currency' =>'CFA'],
            ['currency_code' =>'XPF', 'currency_name' =>'CFP franc',   'currency' =>'₣'], 
            ['currency_code' =>'YER', 'currency_name' =>'Yemeni Rial',   'currency' =>'﷼'], 
            ['currency_code' =>'ZAR', 'currency_name' =>'South African Rand',   'currency' =>'R'],
            ['currency_code' =>'ZMW', 'currency_name' =>'Zambian Kwacha',   'currency' =>'ZK']

            
        ]);
    }
}
