<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Http\Services\QuotationService;
use App\Http\Services\TripService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QuotationController extends Controller
{
    public function calculate(QuotationRequest $request)
    {
        try {
            $trip = new TripService($request->get('age'),
                $request->get('currency_id'),
                $request->get('start_date'),
                $request->get('end_date')
            );

            $quotationService = new QuotationService($trip);

            return Response::json([
                'total' => $quotationService->calculate(),
                'currency_id' => $trip->getCurrency(),
                'quotation_id' => $quotationService->getQuotationId()
            ]);

        } catch (\Exception $exception) {
            return Response::json(['error' => $exception->getMessage()], 500);
        }
    }
}
