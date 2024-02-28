import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class RentNPropertyTab extends HookWidget {
  const RentNPropertyTab({Key? key, this.onComplete}) : super(key: key);

  final Function()? onComplete;
  @override
  Widget build(BuildContext context) {
    final formKey = GlobalKey<FormState>();
    final propertyType = useState('residiential');
    final ownership = useState('owned');

    final address = useTextEditingController();
    final totalArea = useTextEditingController();
    final annualRentalIncome = useTextEditingController();
    final repair = useTextEditingController();
    final localTax = useTextEditingController();
    final landRevenue = useTextEditingController();
    final loanInterestOrCapitalCharge = useTextEditingController();
    final insurancePremium = useTextEditingController();
    final vacancyAllowance = useTextEditingController();
    final other = useTextEditingController();
    final claimedExpensesTotal = useTextEditingController();
    final netPropertyIncome = useTextEditingController();
    final propertySharePercent = useTextEditingController();
    final shareOfIncome = useTextEditingController();

    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.rent_n_property,
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Form(
            key: formKey,
            child: ListView(
              children: [
                Text(
                  AppLocalizations.of(context)!.house_property_type,
                  style: Theme.of(context).textTheme.titleLarge,
                ),
                const SizedBox(height: 16),
                GestureDetector(
                  onTap: () => propertyType.value = 'residiential',
                  child: Row(
                    children: [
                      Container(
                        width: 22,
                        height: 22,
                        padding: const EdgeInsets.all(3),
                        decoration: BoxDecoration(
                          border: Border.all(
                            color: Theme.of(context).colorScheme.primary,
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(6),
                        ),
                        child: propertyType.value == 'residiential'
                            ? Container(
                                decoration: BoxDecoration(
                                  color: Theme.of(context).colorScheme.primary,
                                  borderRadius: BorderRadius.circular(3),
                                ),
                              )
                            : null,
                      ),
                      const SizedBox(width: 12),
                      Text(
                        AppLocalizations.of(context)!.residential,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 16),
                GestureDetector(
                  onTap: () => propertyType.value = 'commercial',
                  child: Row(
                    children: [
                      Container(
                        width: 22,
                        height: 22,
                        padding: const EdgeInsets.all(3),
                        decoration: BoxDecoration(
                          border: Border.all(
                            color: Theme.of(context).colorScheme.primary,
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(6),
                        ),
                        child: propertyType.value == 'commercial'
                            ? Container(
                                decoration: BoxDecoration(
                                  color: Theme.of(context).colorScheme.primary,
                                  borderRadius: BorderRadius.circular(3),
                                ),
                              )
                            : null,
                      ),
                      const SizedBox(width: 12),
                      Text(
                        AppLocalizations.of(context)!.commercial,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 16),
                Row(
                  children: [
                    Expanded(
                      child: GestureDetector(
                        onTap: () => ownership.value = 'owned',
                        child: Container(
                          height: 50,
                          decoration: BoxDecoration(
                            color: ownership.value == 'owned'
                                ? Theme.of(context)
                                    .colorScheme
                                    .primary
                                    .withOpacity(0.25)
                                : Theme.of(context).colorScheme.secondary,
                            border: Border.all(
                              width: 0.5,
                              color: Theme.of(context)
                                  .colorScheme
                                  .primary
                                  .withOpacity(0.5),
                            ),
                            borderRadius: const BorderRadius.only(
                              topLeft: Radius.circular(50),
                              bottomLeft: Radius.circular(50),
                            ),
                          ),
                          child: Center(
                            child: Text(
                              AppLocalizations.of(context)!.owned,
                              style: Theme.of(context)
                                  .textTheme
                                  .titleMedium
                                  ?.copyWith(
                                    color: ownership.value == 'owned'
                                        ? Theme.of(context).colorScheme.primary
                                        : null,
                                    fontWeight: ownership.value == 'owned'
                                        ? FontWeight.w600
                                        : null,
                                  ),
                            ),
                          ),
                        ),
                      ),
                    ),
                    Expanded(
                      child: GestureDetector(
                        onTap: () => ownership.value = 'partiallyOwned',
                        child: Container(
                          height: 50,
                          decoration: BoxDecoration(
                            color: ownership.value == 'partiallyOwned'
                                ? Theme.of(context)
                                    .colorScheme
                                    .primary
                                    .withOpacity(0.25)
                                : Theme.of(context).colorScheme.secondary,
                            border: Border.all(
                              width: 0.5,
                              color: Theme.of(context)
                                  .colorScheme
                                  .primary
                                  .withOpacity(0.5),
                            ),
                            borderRadius: const BorderRadius.only(
                              topRight: Radius.circular(50),
                              bottomRight: Radius.circular(50),
                            ),
                          ),
                          child: Center(
                            child: Text(
                              AppLocalizations.of(context)!.partially_owned,
                              style: Theme.of(context)
                                  .textTheme
                                  .titleMedium
                                  ?.copyWith(
                                    color: ownership.value == 'partiallyOwned'
                                        ? Theme.of(context).colorScheme.primary
                                        : null,
                                    fontWeight:
                                        ownership.value == 'partiallyOwned'
                                            ? FontWeight.w600
                                            : null,
                                  ),
                            ),
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 24),
                Text(
                  AppLocalizations.of(context)!.property_address,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: address,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.total_area,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: totalArea,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.annual_rental_income,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: annualRentalIncome,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.repair,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: repair,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.local_tax,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: localTax,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.land_revenue,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: landRevenue,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.loan_interest_or_capital_charge,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: loanInterestOrCapitalCharge,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.insurance_premium,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: insurancePremium,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.vacancy_allowance,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: vacancyAllowance,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.other,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: other,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.claimed_expenses_total,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: claimedExpensesTotal,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.net_property_income,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: netPropertyIncome,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                if (ownership.value == 'partiallyOwned') ...[
                  const SizedBox(height: 24),
                  Text(
                    AppLocalizations.of(context)!.partially_owned_information,
                    style: Theme.of(context).textTheme.titleLarge,
                  ),
                  const SizedBox(height: 16),
                  Text(
                    AppLocalizations.of(context)!.property_share_percent,
                    style: Theme.of(context).textTheme.titleMedium,
                  ),
                  const SizedBox(height: 8),
                  TextField(
                    controller: propertySharePercent,
                    onEditingComplete: () => FocusScope.of(context).nextFocus(),
                  ),
                  const SizedBox(height: 12),
                  Text(
                    AppLocalizations.of(context)!.share_of_income,
                    style: Theme.of(context).textTheme.titleMedium,
                  ),
                  const SizedBox(height: 8),
                  TextField(
                    controller: shareOfIncome,
                    onEditingComplete: () => FocusScope.of(context).nextFocus(),
                  ),
                ],
                const SizedBox(height: 24),
                PrimaryButton(
                  onTap: () {
                    if (formKey.currentState?.validate() ?? false) {
                      Navigator.pop(context, true);
                    }
                  },
                  text: AppLocalizations.of(context)!.done,
                ),
                const SizedBox(height: 12),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      AppLocalizations.of(context)!.any_queries,
                      style: Theme.of(context).textTheme.titleMedium,
                    ),
                    TextButton(
                      onPressed: () {},
                      child: Text(
                        AppLocalizations.of(context)!.live_chat,
                        style: Theme.of(context).textTheme.titleLarge?.copyWith(
                              color: Theme.of(context).colorScheme.primary,
                            ),
                      ),
                    )
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
