import 'package:expansion_tile_card/expansion_tile_card.dart';
import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class CategoryScreen extends HookWidget {
  const CategoryScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final categories = {
      AppLocalizations.of(context)!.salary: [
        'Salary Certificate',
        'Bank Statement',
        'Supporting Documents for Investment Allowance',
        'Your Signature',
      ],
      AppLocalizations.of(context)!.interests_on_security: [
        'Bond/debenture certificate',
        'Bank statement for interest income',
        'Loan statement for purchase of bond/debenture',
      ],
      AppLocalizations.of(context)!.rent_n_property: [
        'Bank Statements',
        'Official Document',
      ],
    };

    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.upload_documents,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          children: [
            Expanded(
              child: ListView(
                children: categories.keys
                    .map<Widget>(
                      (category) => Container(
                        margin: const EdgeInsets.only(bottom: 12),
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(20),
                          border: Border.all(
                            width: 0.5,
                            color: Theme.of(context)
                                .colorScheme
                                .primary
                                .withOpacity(0.25),
                          ),
                        ),
                        child: ExpansionTileCard(
                          elevation: 0,
                          baseColor: Theme.of(context).colorScheme.secondary,
                          expandedColor:
                              Theme.of(context).colorScheme.secondary,
                          expandedTextColor:
                              Theme.of(context).colorScheme.primary,
                          borderRadius: BorderRadius.circular(20),
                          title: Text(category),
                          children: [
                            Row(
                              children: [
                                Padding(
                                  padding:
                                      const EdgeInsets.symmetric(horizontal: 32)
                                          .copyWith(
                                    bottom: 20,
                                  ),
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: categories[category]!
                                        .map<Widget>(
                                          (subCategory) => InkWell(
                                            onTap: () => Navigator.pushNamed(
                                              context,
                                              Routes.uploadDocuments,
                                              arguments: {
                                                'category': category,
                                                'subCategory': subCategory,
                                              },
                                            ),
                                            child: Padding(
                                              padding: const EdgeInsets.all(5),
                                              child: SizedBox(
                                                width: MediaQuery.of(context)
                                                        .size
                                                        .width -
                                                    120,
                                                child: Text(
                                                  subCategory,
                                                  maxLines: 2,
                                                ),
                                              ),
                                            ),
                                          ),
                                        )
                                        .toList(),
                                  ),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ),
                    )
                    .toList(),
              ),
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
    );
  }
}
