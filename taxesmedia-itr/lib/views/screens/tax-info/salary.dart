import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/controllers/tax_calculator.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';
import 'package:timelines/timelines.dart';

class SalaryInfoScreen extends HookConsumerWidget {
  const SalaryInfoScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final TaxCalculator taxCalculator = useMemoized(
      () => ref.read(taxCalculatorProvider),
    );

    final steps = [
      AppLocalizations.of(context)!.step_1,
      AppLocalizations.of(context)!.step_2,
      AppLocalizations.of(context)!.step_3,
    ];

    final currentStep = useState(0);

    final stepOneFormKey = useMemoized(() => GlobalKey<FormState>());
    final stepTwoFormKey = useMemoized(() => GlobalKey<FormState>());
    final stepThreeFormKey = useMemoized(() => GlobalKey<FormState>());

    final basicPay = useTextEditingController(
      text: taxCalculator.basicPay == 0
          ? null
          : taxCalculator.basicPay.toStringAsFixed(0),
    );
    final specialPay = useTextEditingController();
    final dearness = useTextEditingController(
      text: taxCalculator.dearness == 0
          ? null
          : taxCalculator.dearness.toStringAsFixed(0),
    );
    final conveyance = useTextEditingController(
      text: taxCalculator.conveyance == 0
          ? null
          : taxCalculator.conveyance.toStringAsFixed(0),
    );
    final houseRent = useTextEditingController(
      text: taxCalculator.houseRent == 0
          ? null
          : taxCalculator.houseRent.toStringAsFixed(0),
    );
    final medical = useTextEditingController(
      text: taxCalculator.medical == 0
          ? null
          : taxCalculator.medical.toStringAsFixed(0),
    );
    final medicalDisabled = useTextEditingController();
    final surgery = useTextEditingController();
    final supportStaff = useTextEditingController();
    final leaveFair = useTextEditingController();
    final leaveEncashment = useTextEditingController();
    final honorarium = useTextEditingController();
    final overtime = useTextEditingController(
      text: taxCalculator.overtime == 0
          ? null
          : taxCalculator.overtime.toStringAsFixed(0),
    );
    final bonus = useTextEditingController(
      text: taxCalculator.bonus == 0
          ? null
          : taxCalculator.bonus.toStringAsFixed(0),
    );
    final otherAllowance = useTextEditingController();
    final employersContributeProvident = useTextEditingController();
    final interestAccruedProvident = useTextEditingController();
    final transportFromEmployer = useState(taxCalculator.transportFromEmployer);
    final others = useTextEditingController();
    final incomeGratuityFund = useTextEditingController();
    final incomeWorkersProfitFund = useTextEditingController();
    final pension = useTextEditingController();
    final incomeProvidentFund = useTextEditingController();
    final netTaxableFund = useTextEditingController();

    final scrollController = useScrollController();

    return GradientScaffold(
      appBar: TransparentAppBar(title: AppLocalizations.of(context)!.salary),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            SizedBox(
              height: 70,
              child: Center(
                child: FixedTimeline.tileBuilder(
                  theme: TimelineThemeData(
                    nodePosition: 0,
                    direction: Axis.horizontal,
                  ),
                  builder: TimelineTileBuilder.connected(
                    connectionDirection: ConnectionDirection.before,
                    itemCount: steps.length,
                    itemExtentBuilder: (_, __) =>
                        (MediaQuery.of(context).size.width - 32) / steps.length,
                    contentsBuilder: (context, index) {
                      return Padding(
                        padding: const EdgeInsets.symmetric(
                          vertical: 8.0,
                          horizontal: 5,
                        ),
                        child: Text(
                          steps[index],
                          style:
                              Theme.of(context).textTheme.labelMedium?.copyWith(
                                    color: index < currentStep.value
                                        ? Theme.of(context).colorScheme.primary
                                        : Colors.black54,
                                  ),
                          textAlign: TextAlign.center,
                        ),
                      );
                    },
                    indicatorBuilder: (_, index) {
                      if (index < currentStep.value) {
                        return ContainerIndicator(
                          size: 25.0,
                          child: Container(
                            decoration: BoxDecoration(
                              color: Theme.of(context).colorScheme.primary,
                              borderRadius: BorderRadius.circular(5),
                            ),
                            child: const Icon(
                              Icons.check,
                              color: Colors.white,
                              size: 15.0,
                            ),
                          ),
                        );
                      } else {
                        return ContainerIndicator(
                          size: 25,
                          child: Container(
                            decoration: BoxDecoration(
                              border: Border.all(
                                width: 1.5,
                                color: Colors.black54,
                              ),
                              borderRadius: BorderRadius.circular(5),
                            ),
                            child: index == currentStep.value
                                ? const Icon(
                                    Icons.square,
                                    size: 15,
                                    color: Colors.black54,
                                  )
                                : null,
                          ),
                        );
                      }
                    },
                    connectorBuilder: (_, index, type) {
                      return SolidLineConnector(
                        thickness: 1.4,
                        color: currentStep.value >= index
                            ? Theme.of(context).colorScheme.primary
                            : Colors.black54,
                      );
                    },
                  ),
                ),
              ),
            ),
            Expanded(
              child: ListView(
                controller: scrollController,
                children: [
                  if (currentStep.value == 0)
                    stepOneForm(
                      context,
                      stepOneFormKey,
                      basicPay,
                      specialPay,
                      dearness,
                      conveyance,
                      houseRent,
                      medical,
                      medicalDisabled,
                      surgery,
                    ),
                  if (currentStep.value == 1)
                    stepTwoForm(
                      context,
                      stepTwoFormKey,
                      supportStaff,
                      leaveFair,
                      leaveEncashment,
                      honorarium,
                      overtime,
                      bonus,
                      otherAllowance,
                    ),
                  if (currentStep.value == 2)
                    stepThreeForm(
                      context,
                      stepThreeFormKey,
                      employersContributeProvident,
                      interestAccruedProvident,
                      transportFromEmployer,
                      others,
                      incomeGratuityFund,
                      incomeWorkersProfitFund,
                      pension,
                      incomeProvidentFund,
                      netTaxableFund,
                    ),
                  const SizedBox(height: 24),
                  PrimaryButton(
                    onTap: () {
                      if (stepOneFormKey.currentState?.validate() ??
                          stepTwoFormKey.currentState?.validate() ??
                          stepThreeFormKey.currentState?.validate() ??
                          false) {
                        taxCalculator.basicPay =
                            double.tryParse(basicPay.text) ?? 0;
                        taxCalculator.dearness =
                            double.tryParse(dearness.text) ?? 0;
                        taxCalculator.conveyance =
                            double.tryParse(conveyance.text) ?? 0;
                        taxCalculator.houseRent =
                            double.tryParse(houseRent.text) ?? 0;
                        taxCalculator.medical =
                            double.tryParse(medical.text) ?? 0;
                        taxCalculator.overtime =
                            double.tryParse(overtime.text) ?? 0;
                        taxCalculator.bonus = double.tryParse(bonus.text) ?? 0;
                        taxCalculator.transportFromEmployer =
                            transportFromEmployer.value;

                        if (currentStep.value < 2) {
                          currentStep.value++;
                          scrollController.jumpTo(0);
                        } else {
                          Navigator.pop(context, true);
                        }
                      }
                    },
                    text: currentStep.value < 2
                        ? AppLocalizations.of(context)!.next
                        : AppLocalizations.of(context)!.done,
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
                          style: Theme.of(context)
                              .textTheme
                              .titleLarge
                              ?.copyWith(
                                color: Theme.of(context).colorScheme.primary,
                              ),
                        ),
                      )
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Form stepOneForm(
    BuildContext context,
    GlobalKey formKey,
    TextEditingController basicPay,
    TextEditingController specialPay,
    TextEditingController dearness,
    TextEditingController conveyance,
    TextEditingController houseRent,
    TextEditingController medical,
    TextEditingController medicalDisabled,
    TextEditingController surgery,
  ) {
    return Form(
      key: formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            AppLocalizations.of(context)!.basic_pay,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: basicPay,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) {
                return 'Basic pay is required';
              }
              try {
                int.parse(value!.trim());
              } catch (e) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.special_pay,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: specialPay,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.dearness_allowance,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: dearness,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.conveyance_allowance,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: conveyance,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.house_rent_allowance,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: houseRent,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.medical_allowance_without_disability,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: medical,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.medical_allowance_disabled_person,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: medicalDisabled,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.surgery_amount,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: surgery,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            autovalidateMode: AutovalidateMode.onUserInteraction,
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
        ],
      ),
    );
  }

  Form stepTwoForm(
      BuildContext context,
      GlobalKey formKey,
      TextEditingController supportStaff,
      TextEditingController leaveFair,
      TextEditingController leaveEncashment,
      TextEditingController honorarium,
      TextEditingController overtime,
      TextEditingController bonus,
      TextEditingController other) {
    return Form(
      key: formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            AppLocalizations.of(context)!.allowance_support_staff,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: supportStaff,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.leave_fair_assistance,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: leaveFair,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.leave_encashment,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: leaveEncashment,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.honorarium_or_reward,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: honorarium,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.overtime_allowance,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: overtime,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.bonus,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: bonus,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.other_allowance,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: other,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
        ],
      ),
    );
  }

  Form stepThreeForm(
      BuildContext context,
      GlobalKey formKey,
      TextEditingController employersContributeProvident,
      TextEditingController interestAccruedProvident,
      ValueNotifier<bool> transportFromEmployer,
      TextEditingController others,
      TextEditingController incomeGratuityFund,
      TextEditingController incomeWorkersProfitFund,
      TextEditingController pension,
      TextEditingController incomeProvidentFund,
      TextEditingController netTaxableFund) {
    return Form(
      key: formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            AppLocalizations.of(context)!.employers_contribution_provident_fund,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: employersContributeProvident,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.interests_accrued_provident_fund,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: interestAccruedProvident,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.transport_from_employer,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          DropdownButtonFormField<bool>(
            value: transportFromEmployer.value,
            items: [
              DropdownMenuItem(
                value: true,
                child: Text(AppLocalizations.of(context)!.yes),
              ),
              DropdownMenuItem(
                value: false,
                child: Text(AppLocalizations.of(context)!.no),
              ),
            ],
            onChanged: (value) {
              transportFromEmployer.value = value ?? false;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.others,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: others,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.income_gratuity_fund,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: incomeGratuityFund,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.income_workers_profit_fund,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: incomeWorkersProfitFund,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.pension,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: pension,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.income_provident_fund,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: incomeProvidentFund,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.net_texable_fund,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextFormField(
            controller: netTaxableFund,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
            validator: (value) {
              if (value?.trim().isEmpty ?? true) return null;
              if (int.tryParse(value!.trim()) == null) {
                return 'Invalid value';
              }
              return null;
            },
          ),
        ],
      ),
    );
  }
}
