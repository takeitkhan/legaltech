import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/core/models/package.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class PackageDetailsScreen extends HookWidget {
  const PackageDetailsScreen({
    Key? key,
    required this.package,
  }) : super(key: key);

  final Package package;

  @override
  Widget build(BuildContext context) {
    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.package_details,
      ),
      body: Padding(
        padding: const EdgeInsets.only(top: 10),
        child: Material(
          color: Theme.of(context).colorScheme.secondary.withOpacity(0.7),
          shape: RoundedRectangleBorder(
            borderRadius: const BorderRadius.vertical(
              top: Radius.circular(60),
            ),
            side: BorderSide(
              color: Theme.of(context).colorScheme.primary,
              width: 0.2,
            ),
          ),
          child: SafeArea(
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                children: [
                  const SizedBox(height: 10),
                  Text(
                    package.title,
                    style: Theme.of(context).textTheme.headline5?.copyWith(
                          fontWeight: FontWeight.bold,
                        ),
                  ),
                  const SizedBox(height: 5),
                  Text(
                    AppLocalizations.of(context)!.you_will_be_provided_with,
                    style: Theme.of(context).textTheme.headline6?.copyWith(
                          fontWeight: FontWeight.w500,
                        ),
                  ),
                  const SizedBox(height: 20),
                  Expanded(
                    child: ListView.builder(
                      itemCount: package.benefits.length,
                      itemBuilder: (context, index) {
                        return Padding(
                          padding: const EdgeInsets.symmetric(
                            vertical: 10,
                            horizontal: 20,
                          ),
                          child: Column(
                            children: [
                              Container(
                                padding: const EdgeInsets.all(4),
                                decoration: BoxDecoration(
                                  color: Colors.white.withOpacity(0.5),
                                  shape: BoxShape.circle,
                                ),
                                child: const Icon(
                                  Icons.done,
                                  size: 20,
                                  color: Colors.green,
                                ),
                              ),
                              const SizedBox(height: 10),
                              Text(
                                package.benefits[index],
                                textAlign: TextAlign.center,
                              ),
                            ],
                          ),
                        );
                      },
                    ),
                  ),
                  const SizedBox(height: 20),
                  PrimaryButton(
                    onTap: () {
                      showModalBottomSheet(
                        context: context,
                        builder: (context) => PaymentSheet(package: package),
                        backgroundColor:
                            Theme.of(context).colorScheme.secondary,
                        shape: const RoundedRectangleBorder(
                          borderRadius: BorderRadius.vertical(
                            top: Radius.circular(60),
                          ),
                        ),
                        isScrollControlled: true,
                      );
                    },
                    text: AppLocalizations.of(context)!.purchase,
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}

class PaymentSheet extends HookWidget {
  const PaymentSheet({
    Key? key,
    required this.package,
  }) : super(key: key);

  final Package package;

  @override
  Widget build(BuildContext context) {
    final acceptAgreement = useState(false);
    return FractionallySizedBox(
      heightFactor: 0.8,
      child: Padding(
        padding: const EdgeInsets.symmetric(
          vertical: 16,
          horizontal: 32,
        ).copyWith(top: 40),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  AppLocalizations.of(context)!.amount,
                  style: Theme.of(context).textTheme.headline5,
                ),
                Text(
                  '\$${package.price}',
                  style: Theme.of(context).textTheme.headline5,
                ),
              ],
            ),
            const SizedBox(height: 10),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  '${AppLocalizations.of(context)!.vat} (15%)',
                  style: Theme.of(context).textTheme.headline6,
                ),
                Text(
                  '\$${package.price * package.vat / 100}',
                  style: Theme.of(context).textTheme.headline6,
                ),
              ],
            ),
            const Divider(
              height: 30,
              thickness: 1,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  AppLocalizations.of(context)!.total,
                  style: Theme.of(context).textTheme.headline5,
                ),
                Text(
                  '\$${package.price + (package.price * package.vat / 100)}',
                  style: Theme.of(context).textTheme.headline5,
                ),
              ],
            ),
            const Divider(
              height: 30,
              thickness: 1,
            ),
            const SizedBox(height: 10),
            Text(
              AppLocalizations.of(context)!.apply_coupon,
              style: Theme.of(context).textTheme.titleMedium?.copyWith(
                    color: Theme.of(context).colorScheme.primary,
                  ),
            ),
            const SizedBox(height: 10),
            SizedBox(
              height: 50,
              child: Row(
                children: [
                  const Expanded(
                    flex: 3,
                    child: TextField(),
                  ),
                  const SizedBox(width: 10),
                  Flexible(
                    child: PrimaryButton(
                      onTap: () {},
                      text: AppLocalizations.of(context)!.apply,
                    ),
                  ),
                ],
              ),
            ),
            const SizedBox(height: 10),
            Text(
              '${AppLocalizations.of(context)!.tin} 98475934',
              style: Theme.of(context).textTheme.titleLarge,
            ),
            const SizedBox(height: 10),
            const Spacer(),
            GestureDetector(
              onTap: () => acceptAgreement.value = !acceptAgreement.value,
              child: Row(
                children: [
                  SizedBox(
                    width: 24,
                    height: 24,
                    child: Checkbox(
                      value: acceptAgreement.value,
                      onChanged: (value) {
                        acceptAgreement.value = value ?? false;
                      },
                      activeColor: Theme.of(context).colorScheme.primary,
                    ),
                  ),
                  const SizedBox(width: 6),
                  Expanded(
                    child: Text(
                      AppLocalizations.of(context)!.use_agreement,
                      style: Theme.of(context).textTheme.labelMedium,
                      maxLines: 2,
                    ),
                  ),
                ],
              ),
            ),
            const SizedBox(height: 10),
            PrimaryButton(
              onTap: () {},
              text: AppLocalizations.of(context)!.pay,
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
                  onPressed: () {
                    if (acceptAgreement.value) {}
                  },
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
    );
  }
}
